<?php

namespace App\Controllers;

use App\Models\DatasetModel;

class Datasets extends BaseController
{
    public function index(): string
    {
        $datasetModel = new DatasetModel();
        $search = trim((string) ($this->request->getGet('q') ?? ''));
        $dataType = trim((string) ($this->request->getGet('data_type') ?? ''));
        $category = trim((string) ($this->request->getGet('category') ?? ''));

        $query = $datasetModel
            ->select('datasets.*, users.name AS author_name')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.status', DatasetModel::STATUS_APPROVED)
            ->where('datasets.archived_at', null);

        if ($search !== '') {
            $query->groupStart()
                ->like('datasets.title', $search)
                ->orLike('datasets.description', $search)
                ->orLike('datasets.tags', $search)
                ->orLike('datasets.category', $search)
                ->groupEnd();
        }

        if ($dataType !== '') {
            $query->where('datasets.data_type', $dataType);
        }

        if ($category !== '') {
            $query->where('datasets.category', $category);
        }

        $datasets = $query
            ->orderBy('datasets.approved_at', 'DESC')
            ->orderBy('datasets.created_at', 'DESC')
            ->findAll();

        $categories = $datasetModel
            ->select('category')
            ->where('status', DatasetModel::STATUS_APPROVED)
            ->where('archived_at', null)
            ->where('category !=', '')
            ->groupBy('category')
            ->orderBy('category', 'ASC')
            ->findColumn('category');

        return view('datasets/index', [
            'title' => 'Dataset Catalog',
            'datasets' => $datasets,
            'search' => $search,
            'selectedDataType' => $dataType,
            'selectedCategory' => $category,
            'categories' => $categories ?: [],
        ]);
    }

    public function show(int $id): string
    {
        $datasetModel = new DatasetModel();
        $dataset = $datasetModel
            ->select('datasets.*, users.name AS author_name')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.id', $id)
            ->where('datasets.status', DatasetModel::STATUS_APPROVED)
            ->where('datasets.archived_at', null)
            ->first();

        if (! is_array($dataset)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('datasets/show', [
            'title' => $dataset['title'],
            'datasetId' => $id,
            'dataset' => $dataset,
        ]);
    }

    public function download(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id)
            ->with('info', 'Download authorization and file response are ready for Member 4 implementation.');
    }

    public function edit(int $id): string
    {
        $datasetModel = new DatasetModel();
        $dataset = $datasetModel->find($id);

        if (! is_array($dataset)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('datasets/edit', [
            'title' => 'Edit Dataset',
            'datasetId' => $id,
            'dataset' => $dataset,
            'dataTypes' => ['Tabular', 'Text', 'Image', 'Audio', 'Video'],
            'sourceTypes' => ['Primary', 'Secondary'],
            'accessTypes' => ['public', 'restricted'],
        ]);
    }

    public function update(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id . '/edit')
            ->with('info', 'Dataset update logic is ready for Member 3 implementation.');
    }

    public function archive(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id)
            ->with('info', 'Dataset archive logic is ready for Member 3 implementation.');
    }
}
