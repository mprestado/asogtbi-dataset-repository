<?php

namespace App\Controllers;

use App\Models\DatasetModel;

class Home extends BaseController
{
    public function index(): string
    {
        $datasetModel = new DatasetModel();

        $featuredDatasets = $datasetModel
            ->select('datasets.*, users.name AS author_name')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.status', DatasetModel::STATUS_PUBLISHED)
            ->where('datasets.access_type', DatasetModel::ACCESS_PUBLIC)
            ->where('datasets.archived_at', null)
            ->orderBy('datasets.created_at', 'DESC')
            ->findAll(3);

        return view('home/index', [
            'title' => 'ASOG TBI Dataset Repository',
            'publishedCount' => model(DatasetModel::class)
                ->where('status', DatasetModel::STATUS_PUBLISHED)
                ->where('archived_at', null)
                ->countAllResults(),
            'featuredDatasets' => $featuredDatasets,
        ]);
    }
}
