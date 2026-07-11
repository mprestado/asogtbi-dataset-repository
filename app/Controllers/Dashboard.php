<?php

namespace App\Controllers;

use App\Models\DatasetModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $datasetModel = new DatasetModel();
        $userId = (int) $this->currentUserId();
        $myDatasets = $datasetModel
            ->where('contributor_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('dashboard/index', [
            'title' => 'My Datasets',
            'myDatasets' => $myDatasets,
            'statusLabels' => DatasetModel::statusLabels(),
            'statusCounts' => [
                'published' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->where('status', DatasetModel::STATUS_PUBLISHED)
                    ->where('archived_at', null)
                    ->countAllResults(),
                'pending' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->where('status', DatasetModel::STATUS_PENDING)
                    ->countAllResults(),
                'needsRevision' => model(DatasetModel::class)
                    ->where('contributor_id', $userId)
                    ->where('status', DatasetModel::STATUS_REVISION_REQUESTED)
                    ->countAllResults(),
            ],
        ]);
    }
}
