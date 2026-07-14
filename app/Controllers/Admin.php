<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\DatasetFileModel;
use App\Models\DatasetVersionModel;
use App\Models\ReviewModel;
use App\Models\UserModel;
use App\Services\ModerationWorkflow;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class Admin extends BaseController
{
    public function index(): string
    {
        $counts = [];
        foreach (DatasetModel::statusLabels() as $status => $label) {
            $counts[$status] = model(DatasetModel::class)->where('status', $status)->countAllResults();
        }

        return view('admin/index', ['title' => 'Repository Administration', 'counts' => $counts, 'statusLabels' => DatasetModel::statusLabels()]);
    }

    public function datasets(): string
    {
        $datasets = model(DatasetModel::class)->select('datasets.*, users.name AS contributor_name')->join('users', 'users.id = datasets.contributor_id', 'left')->orderBy('datasets.updated_at', 'DESC')->findAll();
        $reviews = model(ReviewModel::class)->select('reviews.*, users.name AS reviewer_name')->join('users', 'users.id = reviews.reviewer_id', 'left')->orderBy('reviews.id', 'DESC')->findAll();
        $byDataset = [];
        foreach ($reviews as $review) {
            $byDataset[(int) $review['dataset_id']][] = $review;
        }

        return view('admin/datasets', [
            'title' => 'Dataset Moderation', 'datasets' => $datasets, 'reviewsByDataset' => $byDataset,
            'statusLabels' => DatasetModel::statusLabels(), 'accessOptions' => DatasetModel::accessOptions(),
            'ethicsReviewers' => $this->usersWithRole(ModerationWorkflow::ROLE_ETHICS),
            'technicalReviewers' => $this->usersWithRole(ModerationWorkflow::ROLE_TECHNICAL),
        ]);
    }

    public function dataset(int $datasetId): string
    {
        $dataset = model(DatasetModel::class)
            ->select('datasets.*, users.name AS contributor_name, users.email AS contributor_email')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.id', $datasetId)
            ->first();

        if (! is_array($dataset)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('admin/dataset', [
            'title' => $dataset['title'],
            'dataset' => $dataset,
            'statusLabel' => DatasetModel::statusLabel((string) ($dataset['status'] ?? '')),
            'accessLabel' => DatasetModel::accessLabel((string) ($dataset['access_type'] ?? '')),
            'latestFile' => model(DatasetFileModel::class)->where('dataset_id', $datasetId)->orderBy('created_at', 'DESC')->first(),
            'versions' => model(DatasetVersionModel::class)->where('dataset_id', $datasetId)->orderBy('id', 'DESC')->findAll(),
            'reviews' => model(ReviewModel::class)->select('reviews.*, users.name AS reviewer_name')->join('users', 'users.id = reviews.reviewer_id', 'left')->where('reviews.dataset_id', $datasetId)->orderBy('reviews.id', 'DESC')->findAll(),
        ]);
    }

    public function assign(int $datasetId)
    {
        try {
            (new ModerationWorkflow())->assign($datasetId, trim((string) $this->request->getPost('stage')), (int) $this->request->getPost('reviewer_id'), (int) $this->currentUserId(), $this->request->getIPAddress());
        } catch (RuntimeException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('info', 'Reviewer assignment saved.');
    }

    public function publish(int $datasetId)
    {
        try {
            (new ModerationWorkflow())->publish($datasetId, (int) $this->currentUserId(), trim((string) $this->request->getPost('access_type')), $this->request->getIPAddress());
        } catch (RuntimeException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('info', 'Dataset published successfully.');
    }

    public function archive(int $datasetId)
    {
        return $this->setArchived($datasetId, false);
    }

    public function restore(int $datasetId)
    {
        return $this->setArchived($datasetId, true);
    }

    public function users(): string
    {
        $assignments = db_connect()->table('user_roles')->select('user_roles.user_id, roles.name')->join('roles', 'roles.id = user_roles.role_id')->get()->getResultArray();
        $userRoles = [];
        foreach ($assignments as $assignment) {
            $userRoles[(int) $assignment['user_id']][] = $assignment['name'];
        }

        return view('admin/users', [
            'title' => 'Users and Roles', 'users' => model(UserModel::class)->orderBy('name', 'ASC')->findAll(),
            'userRoles' => $userRoles, 'roles' => db_connect()->table('roles')->orderBy('name')->get()->getResultArray(),
            'currentUserId' => (int) $this->currentUserId(),
        ]);
    }

    public function updateUser(int $userId)
    {
        $user = model(UserModel::class)->find($userId);
        if (! is_array($user)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $status = $this->request->getPost('status') === 'active' ? 'active' : 'inactive';
        $allowed = [ModerationWorkflow::ROLE_USER, ModerationWorkflow::ROLE_ETHICS, ModerationWorkflow::ROLE_TECHNICAL, ModerationWorkflow::ROLE_ADMIN];
        $roles = array_values(array_unique(array_intersect((array) $this->request->getPost('roles'), $allowed)));
        if ($roles === []) {
            return redirect()->back()->with('error', 'Every account must retain at least one role.');
        }
        $removesAdmin = $status !== 'active' || ! in_array(ModerationWorkflow::ROLE_ADMIN, $roles, true);
        if ($userId === (int) $this->currentUserId() && $removesAdmin) {
            return redirect()->back()->with('error', 'You cannot deactivate yourself or remove your own administrator role.');
        }
        if ($removesAdmin && $this->isLastActiveAdministrator($userId)) {
            return redirect()->back()->with('error', 'The final active administrator cannot be removed.');
        }

        $db = db_connect();
        $db->transStart();
        $db->table('users')->where('id', $userId)->update(['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
        $db->table('user_roles')->where('user_id', $userId)->delete();
        foreach ($db->table('roles')->whereIn('name', $roles)->get()->getResultArray() as $role) {
            $db->table('user_roles')->insert(['user_id' => $userId, 'role_id' => (int) $role['id']]);
        }
        $db->transComplete();
        if (! $db->transStatus()) {
            return redirect()->back()->with('error', 'User access could not be updated.');
        }
        $this->recordAudit('user_roles_updated', 'user', $userId, 'Account status and roles updated by repository administrator.');

        return redirect()->back()->with('info', 'User access updated.');
    }

    public function auditLogs(): string
    {
        $search = trim((string) $this->request->getGet('q'));
        $query = db_connect()->table('audit_logs')->select('audit_logs.*, users.name AS user_name')->join('users', 'users.id = audit_logs.user_id', 'left');
        if ($search !== '') {
            $query->groupStart()->like('audit_logs.action', $search)->orLike('audit_logs.details', $search)->orLike('users.name', $search)->groupEnd();
        }

        return view('admin/audit_logs', ['title' => 'Audit Logs', 'logs' => $query->orderBy('audit_logs.created_at', 'DESC')->limit(250)->get()->getResultArray(), 'search' => $search]);
    }

    private function setArchived(int $datasetId, bool $restore)
    {
        try {
            (new ModerationWorkflow())->setArchived($datasetId, (int) $this->currentUserId(), $restore, $this->request->getIPAddress());
        } catch (RuntimeException $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('info', $restore ? 'Dataset restored.' : 'Dataset archived.');
    }

    private function usersWithRole(string $role): array
    {
        return db_connect()->table('users')->select('users.id, users.name, users.email')->join('user_roles', 'user_roles.user_id = users.id')->join('roles', 'roles.id = user_roles.role_id')->where(['roles.name' => $role, 'users.status' => 'active'])->orderBy('users.name')->get()->getResultArray();
    }

    private function isLastActiveAdministrator(int $userId): bool
    {
        $hasRole = db_connect()->table('user_roles')->join('roles', 'roles.id = user_roles.role_id')->where(['user_roles.user_id' => $userId, 'roles.name' => ModerationWorkflow::ROLE_ADMIN])->countAllResults() > 0;
        $count = db_connect()->table('users')->join('user_roles', 'user_roles.user_id = users.id')->join('roles', 'roles.id = user_roles.role_id')->where(['roles.name' => ModerationWorkflow::ROLE_ADMIN, 'users.status' => 'active'])->countAllResults();

        return $hasRole && $count <= 1;
    }
}
