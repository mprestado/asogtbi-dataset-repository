<?php

namespace App\Controllers;

use App\Models\DatasetFileModel;
use App\Models\DatasetModel;
use App\Models\DatasetVersionModel;
use App\Models\NotificationModel;
use App\Models\ReviewModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index', $this->dashboardData('My Datasets'));
    }

    public function portal(): string
    {
        return view('dashboard/portal', $this->dashboardData('Portal Contributor Records'));
    }

    public function portalDataset(int $datasetId): string
    {
        $dataset = model(DatasetModel::class)
            ->where('id', $datasetId)
            ->where('contributor_id', (int) $this->currentUserId())
            ->first();

        if (! is_array($dataset)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('dashboard/portal_dataset', [
            'title' => $dataset['title'],
            'dataset' => $dataset,
            'statusLabel' => DatasetModel::statusLabel((string) ($dataset['status'] ?? '')),
            'accessLabel' => DatasetModel::accessLabel((string) ($dataset['access_type'] ?? '')),
            'latestFile' => model(DatasetFileModel::class)->where('dataset_id', $datasetId)->orderBy('created_at', 'DESC')->first(),
            'versions' => model(DatasetVersionModel::class)->where('dataset_id', $datasetId)->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function readNotifications()
    {
        model(NotificationModel::class)->where('user_id', (int) $this->currentUserId())->where('read_at', null)->set(['read_at' => date('Y-m-d H:i:s')])->update();

        return redirect()->to('/dashboard')->with('info', 'Notifications marked as read.');
    }

    public function readPortalNotifications()
    {
        model(NotificationModel::class)->where('user_id', (int) $this->currentUserId())->where('read_at', null)->set(['read_at' => date('Y-m-d H:i:s')])->update();

        return redirect()->back()->with('info', 'Notifications marked as read.');
    }

    public function pollPortalNotifications()
    {
        $userId = (int) $this->currentUserId();
        $notificationModel = model(NotificationModel::class);
        $latest = $notificationModel
            ->where('user_id', $userId)
            ->where('read_at', null)
            ->orderBy('id', 'DESC')
            ->first();

        return $this->response->setJSON([
            'unreadCount' => $notificationModel->where('user_id', $userId)->where('read_at', null)->countAllResults(),
            'latest' => is_array($latest) ? [
                'id' => (int) $latest['id'],
                'title' => (string) ($latest['title'] ?? 'New activity'),
                'message' => (string) ($latest['message'] ?? ''),
                'link' => ! empty($latest['link']) ? site_url(ltrim((string) $latest['link'], '/')) : null,
            ] : null,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function dashboardData(string $title): array
    {
        $datasetModel = new DatasetModel();
        $userId = (int) $this->currentUserId();
        $datasets = $datasetModel
            ->where('contributor_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $latestReviews = $this->latestReviewsByDataset($datasets);

        return [
            'title' => $title,
            'myDatasets' => $this->decorateDatasets($datasets, $latestReviews),
            'statusLabels' => DatasetModel::statusLabels(),
            'notifications' => model(NotificationModel::class)->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll(8),
            'roles' => $this->currentRoles(),
            'statusCounts' => [
                'published' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->where('status', DatasetModel::STATUS_PUBLISHED)
                    ->where('archived_at', null)
                    ->countAllResults(),
                'pending' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->whereIn('status', [DatasetModel::STATUS_PENDING_ETHICS, DatasetModel::STATUS_PENDING_TECHNICAL, DatasetModel::STATUS_AWAITING_PUBLICATION])
                    ->countAllResults(),
                'needsRevision' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->whereIn('status', [DatasetModel::STATUS_ETHICS_REVISION, DatasetModel::STATUS_TECHNICAL_REVISION])
                    ->countAllResults(),
            ],
        ];
    }

    /**
     * @param list<array<string, mixed>> $datasets
     * @return array<int, array<string, mixed>>
     */
    private function latestReviewsByDataset(array $datasets): array
    {
        $datasetIds = array_values(array_filter(array_map(static fn (array $dataset): int => (int) ($dataset['id'] ?? 0), $datasets)));
        if ($datasetIds === []) {
            return [];
        }

        $reviews = model(ReviewModel::class)
            ->whereIn('dataset_id', $datasetIds)
            ->where('comments !=', '')
            ->orderBy('id', 'DESC')
            ->findAll();
        $latestReviews = [];

        foreach ($reviews as $review) {
            $datasetId = (int) ($review['dataset_id'] ?? 0);
            if ($datasetId > 0 && ! isset($latestReviews[$datasetId])) {
                $latestReviews[$datasetId] = $review;
            }
        }

        return $latestReviews;
    }

    /**
     * @param list<array<string, mixed>> $datasets
     * @param array<int, array<string, mixed>> $latestReviews
     * @return list<array<string, mixed>>
     */
    private function decorateDatasets(array $datasets, array $latestReviews): array
    {
        $ownerName = (string) ($this->session->get('user_name') ?: 'You');

        foreach ($datasets as &$dataset) {
            $datasetId = (int) ($dataset['id'] ?? 0);
            $status = (string) ($dataset['status'] ?? '');
            $accessType = (string) ($dataset['access_type'] ?? DatasetModel::ACCESS_PUBLIC);

            $dataset['statusLabel'] = DatasetModel::statusLabel($status);
            $dataset['accessLabel'] = DatasetModel::accessLabel($accessType);
            $dataset['ownershipLabel'] = $ownerName . ' owns this submission';
            $dataset['latestReview'] = $latestReviews[$datasetId] ?? null;
            $dataset['nextAction'] = DatasetModel::dashboardActionForStatus($status, $datasetId);
            $dataset['canEdit'] = DatasetModel::isRevisionStatus($status) || $status === DatasetModel::STATUS_PUBLISHED;
            $dataset['canArchive'] = ! DatasetModel::isUnderReview($status)
                && ! in_array($status, [DatasetModel::STATUS_ARCHIVED, DatasetModel::STATUS_REJECTED], true);
        }
        unset($dataset);

        return $datasets;
    }
}
