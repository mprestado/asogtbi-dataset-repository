<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\NotificationModel;

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
        ]);
    }

    public function readNotifications()
    {
        model(NotificationModel::class)->where('user_id', (int) $this->currentUserId())->where('read_at', null)->set(['read_at' => date('Y-m-d H:i:s')])->update();

        return redirect()->to('/dashboard')->with('info', 'Notifications marked as read.');
    }
}
