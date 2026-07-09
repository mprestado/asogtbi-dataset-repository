<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        return view('admin/index', [
            'title' => 'Admin Dashboard',
        ]);
    }

    public function users(): string
    {
        return view('admin/users', [
            'title' => 'User Management',
        ]);
    }

    public function activateUser(int $id)
    {
        return redirect()
            ->to('/admin/users')
            ->with('info', "User {$id} activation is ready for team implementation.");
    }

    public function deactivateUser(int $id)
    {
        return redirect()
            ->to('/admin/users')
            ->with('info', "User {$id} deactivation is ready for team implementation.");
    }

    public function datasets(): string
    {
        return view('admin/datasets', [
            'title' => 'Dataset Approval',
        ]);
    }

    public function approveDataset(int $id)
    {
        return redirect()
            ->to('/admin/datasets')
            ->with('info', "Dataset {$id} approval is ready for team implementation.");
    }

    public function rejectDataset(int $id)
    {
        return redirect()
            ->to('/admin/datasets')
            ->with('info', "Dataset {$id} rejection is ready for team implementation.");
    }

    public function auditLogs(): string
    {
        return view('admin/audit_logs', [
            'title' => 'Audit Logs',
        ]);
    }
}
