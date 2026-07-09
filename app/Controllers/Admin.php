<?php

namespace App\Controllers;

use App\Models\AuditLogModel;
use App\Models\DatasetModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $datasetModel = new DatasetModel();
        $auditModel = new AuditLogModel();

        return view('admin/index', [
            'title' => 'Admin Dashboard',
            'adminStats' => [
                'activeUsers' => $userModel->where('status', 'active')->countAllResults(),
                'pendingDatasets' => $datasetModel->where('status', DatasetModel::STATUS_PENDING)->countAllResults(),
                'approvedDatasets' => $datasetModel->where('status', DatasetModel::STATUS_APPROVED)->where('archived_at', null)->countAllResults(),
                'auditEvents' => $auditModel->countAllResults(),
            ],
        ]);
    }

    public function users(): string
    {
        return view('admin/users', [
            'title' => 'User Management',
            'users' => model(UserModel::class)
                ->select('users.*, roles.name AS role_name')
                ->join('user_roles', 'user_roles.user_id = users.id', 'left')
                ->join('roles', 'roles.id = user_roles.role_id', 'left')
                ->orderBy('users.name', 'ASC')
                ->findAll(),
        ]);
    }

    public function activateUser(int $id)
    {
        return redirect()
            ->to('/admin/users')
            ->with('info', "User {$id} activation is ready for Member 1 implementation.");
    }

    public function deactivateUser(int $id)
    {
        return redirect()
            ->to('/admin/users')
            ->with('info', "User {$id} deactivation is ready for Member 1 implementation.");
    }

    public function datasets(): string
    {
        $datasetModel = new DatasetModel();

        return view('admin/datasets', [
            'title' => 'Dataset Approval',
            'pendingDatasets' => $datasetModel
                ->select('datasets.*, users.name AS author_name')
                ->join('users', 'users.id = datasets.contributor_id', 'left')
                ->where('datasets.status', DatasetModel::STATUS_PENDING)
                ->orderBy('datasets.created_at', 'DESC')
                ->findAll(),
            'approvedDatasets' => $datasetModel
                ->select('datasets.*, users.name AS author_name')
                ->join('users', 'users.id = datasets.contributor_id', 'left')
                ->where('datasets.status', DatasetModel::STATUS_APPROVED)
                ->where('datasets.archived_at', null)
                ->orderBy('datasets.created_at', 'DESC')
                ->findAll(5),
        ]);
    }

    public function approveDataset(int $id)
    {
        return redirect()
            ->to('/admin/datasets')
            ->with('info', "Dataset {$id} approval is ready for Member 3 implementation.");
    }

    public function rejectDataset(int $id)
    {
        return redirect()
            ->to('/admin/datasets')
            ->with('info', "Dataset {$id} rejection is ready for Member 3 implementation.");
    }

    public function auditLogs(): string
    {
        return view('admin/audit_logs', [
            'title' => 'Audit Logs',
            'logs' => model(AuditLogModel::class)
                ->select('audit_logs.*, users.name AS user_name')
                ->join('users', 'users.id = audit_logs.user_id', 'left')
                ->orderBy('audit_logs.created_at', 'DESC')
                ->findAll(20),
            'expectedEvents' => [
                'Login and logout',
                'Dataset upload and approval',
                'Dataset download',
                'Dataset update',
                'Dataset archive',
            ],
        ]);
    }
}
