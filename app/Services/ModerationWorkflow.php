<?php

namespace App\Services;

use App\Models\DatasetModel;
use App\Models\ReviewModel;
use CodeIgniter\Database\BaseConnection;
use RuntimeException;

class ModerationWorkflow
{
    public const ROLE_USER = 'user';
    public const ROLE_ETHICS = 'ethics_reviewer';
    public const ROLE_TECHNICAL = 'technical_reviewer';
    public const ROLE_ADMIN = 'repository_administrator';

    public function __construct(private ?BaseConnection $db = null)
    {
        $this->db ??= db_connect();
    }

    public static function checklist(string $stage): array
    {
        $lists = [
            ReviewModel::STAGE_TECHNICAL => [
                'archive_readable' => 'The protected ZIP can be downloaded and opened.',
                'metadata_complete' => 'Required metadata is complete and consistent.',
                'documentation_complete' => 'Documentation is sufficient for repository users.',
                'formats_match' => 'Declared formats match the submitted package.',
                'files_suitable' => 'Files are usable and suitable for publication.',
            ],
            ReviewModel::STAGE_ETHICS => [
                'consent_clearance' => 'Consent and ethics clearance are documented or not applicable.',
                'anonymization' => 'Personal or sensitive data is appropriately anonymized.',
                'sensitive_data' => 'Sensitive-data handling and safeguards are adequate.',
                'source_legitimacy' => 'The source and proposed use are legitimate and documented.',
                'access_classification' => 'The requested access classification is appropriate.',
            ],
        ];
        if (! isset($lists[$stage])) {
            throw new RuntimeException('Unknown review stage.');
        }

        return $lists[$stage];
    }

    public function assign(int $datasetId, string $stage, int $reviewerId, int $adminId, string $ip): int
    {
        if (! in_array($stage, [ReviewModel::STAGE_ETHICS, ReviewModel::STAGE_TECHNICAL], true)) {
            throw new RuntimeException('Invalid review stage.');
        }
        $expected = $stage === ReviewModel::STAGE_ETHICS ? DatasetModel::STATUS_PENDING_ETHICS : DatasetModel::STATUS_PENDING_TECHNICAL;
        $role = $stage === ReviewModel::STAGE_ETHICS ? self::ROLE_ETHICS : self::ROLE_TECHNICAL;

        return $this->transaction(function () use ($datasetId, $stage, $reviewerId, $adminId, $ip, $expected, $role): int {
            $dataset = $this->dataset($datasetId);
            if ($dataset['status'] !== $expected) {
                throw new RuntimeException('This dataset is not ready for the selected review stage.');
            }
            $this->requireRole($adminId, self::ROLE_ADMIN);
            $this->requireRole($reviewerId, $role);
            $active = $this->db->table('reviews')->where(['dataset_id' => $datasetId, 'stage' => $stage, 'status' => ReviewModel::STATUS_ASSIGNED])->orderBy('id', 'DESC')->get()->getRowArray();
            if (is_array($active)) {
                $round = (int) $active['review_round'];
                $this->db->table('reviews')->where('id', $active['id'])->update(['status' => ReviewModel::STATUS_REASSIGNED, 'comments' => 'Reassigned by repository administrator.', 'decided_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
            } else {
                $last = $this->db->table('reviews')->selectMax('review_round')->where(['dataset_id' => $datasetId, 'stage' => $stage])->get()->getRowArray();
                $round = max(1, ((int) ($last['review_round'] ?? 0)) + 1);
            }
            $version = $this->db->table('dataset_versions')->where('dataset_id', $datasetId)->orderBy('id', 'DESC')->get()->getRowArray();
            $now = date('Y-m-d H:i:s');
            $this->db->table('reviews')->insert(['dataset_id' => $datasetId, 'dataset_version_id' => $version['id'] ?? null, 'stage' => $stage, 'review_round' => $round, 'reviewer_id' => $reviewerId, 'assigned_by' => $adminId, 'status' => ReviewModel::STATUS_ASSIGNED, 'assigned_at' => $now, 'created_at' => $now, 'updated_at' => $now]);
            $id = (int) $this->db->insertID();
            $this->notify($reviewerId, 'review_assigned', 'Review assigned', 'A dataset has been assigned to your ' . $stage . ' review queue.', '/review/' . $stage . '/' . $id);
            $this->audit($adminId, 'review_assigned', 'review', $id, 'Assigned ' . $stage . ' review for dataset #' . $datasetId . '.', $ip);

            return $id;
        });
    }

    public function decide(int $reviewId, int $reviewerId, string $decision, array $checklist, string $comments, string $ip): void
    {
        if (! in_array($decision, [ReviewModel::STATUS_APPROVED, ReviewModel::STATUS_REJECTED, ReviewModel::STATUS_REVISION], true)) {
            throw new RuntimeException('Invalid review decision.');
        }
        if ($decision !== ReviewModel::STATUS_APPROVED && trim($comments) === '') {
            throw new RuntimeException('Comments are required for rejection or revision requests.');
        }
        $this->transaction(function () use ($reviewId, $reviewerId, $decision, $checklist, $comments, $ip): void {
            $review = $this->db->table('reviews')->where('id', $reviewId)->get()->getRowArray();
            if (! is_array($review) || $review['status'] !== ReviewModel::STATUS_ASSIGNED || (int) $review['reviewer_id'] !== $reviewerId) {
                throw new RuntimeException('This review is not assigned to the current reviewer.');
            }
            $stage = (string) $review['stage'];
            $this->requireRole($reviewerId, $stage === ReviewModel::STAGE_ETHICS ? self::ROLE_ETHICS : self::ROLE_TECHNICAL);
            $dataset = $this->dataset((int) $review['dataset_id']);
            $expected = $stage === ReviewModel::STAGE_ETHICS ? DatasetModel::STATUS_PENDING_ETHICS : DatasetModel::STATUS_PENDING_TECHNICAL;
            if ($dataset['status'] !== $expected) {
                throw new RuntimeException('The dataset workflow changed before this decision was submitted.');
            }
            $answers = [];
            foreach (array_keys(self::checklist($stage)) as $key) {
                $answers[$key] = ! empty($checklist[$key]);
            }
            if ($decision === ReviewModel::STATUS_APPROVED && in_array(false, $answers, true)) {
                throw new RuntimeException('Every checklist item must be confirmed before approval.');
            }
            $next = $decision === ReviewModel::STATUS_REJECTED
                ? DatasetModel::STATUS_REJECTED
                : ($decision === ReviewModel::STATUS_REVISION
                    ? ($stage === ReviewModel::STAGE_ETHICS ? DatasetModel::STATUS_ETHICS_REVISION : DatasetModel::STATUS_TECHNICAL_REVISION)
                    : ($stage === ReviewModel::STAGE_TECHNICAL ? DatasetModel::STATUS_PENDING_ETHICS : DatasetModel::STATUS_AWAITING_PUBLICATION));
            $now = date('Y-m-d H:i:s');
            $this->db->table('reviews')->where('id', $reviewId)->update(['status' => $decision, 'checklist' => json_encode($answers), 'comments' => trim($comments), 'decided_at' => $now, 'updated_at' => $now]);
            $this->db->table('datasets')->where('id', $dataset['id'])->update(['status' => $next, 'approved_by' => null, 'approved_at' => null, 'updated_at' => $now]);
            $message = 'Your dataset "' . $dataset['title'] . '" is now ' . DatasetModel::statusLabel($next) . '.' . (trim($comments) ? ' Reviewer comments: ' . trim($comments) : '');
            $this->notify((int) $dataset['contributor_id'], 'review_result', ucfirst($stage) . ' review completed', $message, '/datasets/' . $dataset['id'] . '/edit');
            $this->audit($reviewerId, 'review_' . $decision, 'review', $reviewId, ucfirst($stage) . ' decision for dataset #' . $dataset['id'] . '.', $ip);
        });
    }

    public function publish(int $datasetId, int $adminId, string $accessType, string $ip): void
    {
        if (! array_key_exists($accessType, DatasetModel::accessOptions())) {
            throw new RuntimeException('Invalid dataset access type.');
        }
        $this->transaction(function () use ($datasetId, $adminId, $accessType, $ip): void {
            $this->requireRole($adminId, self::ROLE_ADMIN);
            $dataset = $this->dataset($datasetId);
            if ($dataset['status'] !== DatasetModel::STATUS_AWAITING_PUBLICATION) {
                throw new RuntimeException('Only technically approved datasets can be published.');
            }
            $now = date('Y-m-d H:i:s');
            $this->db->table('datasets')->where('id', $datasetId)->update(['status' => DatasetModel::STATUS_PUBLISHED, 'access_type' => $accessType, 'approved_by' => $adminId, 'approved_at' => $now, 'archived_at' => null, 'archived_from_status' => null, 'updated_at' => $now]);
            $this->notify((int) $dataset['contributor_id'], 'dataset_published', 'Dataset published', 'Your dataset "' . $dataset['title'] . '" is now published.', '/datasets/' . $datasetId);
            $this->audit($adminId, 'dataset_published', 'dataset', $datasetId, 'Published with access type ' . $accessType . '.', $ip);
        });
    }

    public function setArchived(int $datasetId, int $adminId, bool $restore, string $ip): void
    {
        $this->transaction(function () use ($datasetId, $adminId, $restore, $ip): void {
            $this->requireRole($adminId, self::ROLE_ADMIN);
            $dataset = $this->dataset($datasetId);
            if ($restore && $dataset['status'] !== DatasetModel::STATUS_ARCHIVED) {
                throw new RuntimeException('Only archived datasets can be restored.');
            }
            if (! $restore && $dataset['status'] === DatasetModel::STATUS_ARCHIVED) {
                throw new RuntimeException('This dataset is already archived.');
            }
            $data = $restore
                ? ['status' => (string) ($dataset['archived_from_status'] ?: DatasetModel::STATUS_PENDING_ETHICS), 'archived_at' => null, 'archived_from_status' => null]
                : ['status' => DatasetModel::STATUS_ARCHIVED, 'archived_at' => date('Y-m-d H:i:s'), 'archived_from_status' => $dataset['status']];
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->table('datasets')->where('id', $datasetId)->update($data);
            $this->audit($adminId, $restore ? 'dataset_restore' : 'dataset_archive', 'dataset', $datasetId, 'Dataset lifecycle changed by administrator.', $ip);
        });
    }

    private function transaction(callable $operation): mixed
    {
        $this->db->transBegin();
        try {
            $result = $operation();
            if (! $this->db->transStatus()) {
                throw new RuntimeException('The moderation workflow could not be saved.');
            }
            $this->db->transCommit();

            return $result;
        } catch (\Throwable $exception) {
            $this->db->transRollback();
            throw $exception;
        }
    }

    private function dataset(int $id): array
    {
        $row = $this->db->table('datasets')->where('id', $id)->get()->getRowArray();
        if (! is_array($row)) {
            throw new RuntimeException('Dataset not found.');
        }

        return $row;
    }

    private function requireRole(int $userId, string $role): void
    {
        $row = $this->db->table('user_roles')->join('roles', 'roles.id = user_roles.role_id')->where(['user_roles.user_id' => $userId, 'roles.name' => $role])->get()->getRowArray();
        if (! is_array($row)) {
            throw new RuntimeException('The selected account does not have the required role.');
        }
    }

    private function notify(int $userId, string $type, string $title, string $message, ?string $link): void
    {
        $now = date('Y-m-d H:i:s');
        $this->db->table('notifications')->insert(['user_id' => $userId, 'type' => $type, 'title' => $title, 'message' => $message, 'link' => $link, 'created_at' => $now, 'updated_at' => $now]);
    }

    private function audit(int $userId, string $action, string $entityType, int $entityId, string $details, string $ip): void
    {
        $this->db->table('audit_logs')->insert(['user_id' => $userId, 'action' => $action, 'entity_type' => $entityType, 'entity_id' => $entityId, 'details' => $details, 'ip_address' => $ip, 'created_at' => date('Y-m-d H:i:s')]);
    }
}
