<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $datasetModel = new DatasetModel();
        $userModel = new UserModel();

        return view('dashboard/index', [
            'title' => 'Dashboard',
            'approvedCount' => $datasetModel
                ->where('status', DatasetModel::STATUS_APPROVED)
                ->where('archived_at', null)
                ->countAllResults(),
            'pendingCount' => $datasetModel
                ->where('status', DatasetModel::STATUS_PENDING)
                ->countAllResults(),
            'userCount' => $userModel->countAllResults(),
            'recentDatasets' => $datasetModel
                ->select('title, category, data_type, status, created_at')
                ->orderBy('created_at', 'DESC')
                ->findAll(5),
            'mvpAreas' => [
                'Authentication and role-aware access',
                'Dataset submission with required metadata and ZIP upload',
                'Approved dataset discovery through search and filtering',
                'Citation, download, update, archive, and recommendations',
            ],
        ]);
    }
}
