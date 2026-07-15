<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\DatasetDownloadModel;
use App\Models\DatasetFileModel;
use App\Models\DatasetModel;
use App\Models\DatasetVersionModel;
use App\Models\DatasetViewModel;

class Datasets extends BaseController
{
    public function index(): string
    {
        $datasetModel = new DatasetModel();
        $search = trim((string) ($this->request->getGet('q') ?? ''));
        $dataType = trim((string) ($this->request->getGet('data_type') ?? ''));
        $category = trim((string) ($this->request->getGet('category') ?? ''));
        $fileFormat = trim((string) ($this->request->getGet('file_format') ?? ''));
        $dateUploaded = trim((string) ($this->request->getGet('date_uploaded') ?? ''));

        $query = $datasetModel
            ->select('datasets.*, users.name AS author_name, users.email AS author_email')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.status', DatasetModel::STATUS_PUBLISHED)
            ->where('datasets.archived_at', null);
        $this->applyPublishedAccessScope($query);

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

        if ($fileFormat !== '') {
            $query->where('datasets.file_format', $fileFormat);
        }

        $dateCutoff = $this->dateFilterCutoff($dateUploaded);
        if ($dateCutoff !== null) {
            $query->where('datasets.created_at >=', $dateCutoff);
        }

        $datasets = $query
            ->orderBy('datasets.approved_at', 'DESC')
            ->orderBy('datasets.created_at', 'DESC')
            ->paginate(10);

        $totalDatasets = $datasetModel->pager->getTotal();

        $categoryQuery = model(DatasetModel::class)
            ->select('category')
            ->where('status', DatasetModel::STATUS_PUBLISHED)
            ->where('archived_at', null)
            ->where('category !=', '');
        $this->applyPublishedAccessScope($categoryQuery);
        $categories = $categoryQuery
            ->groupBy('category')
            ->orderBy('category', 'ASC')
            ->findColumn('category');

        $formatQuery = model(DatasetModel::class)
            ->select('file_format')
            ->where('status', DatasetModel::STATUS_PUBLISHED)
            ->where('archived_at', null)
            ->where('file_format !=', '');
        $this->applyPublishedAccessScope($formatQuery);
        $formats = $formatQuery
            ->groupBy('file_format')
            ->orderBy('file_format', 'ASC')
            ->findColumn('file_format');

        return view('datasets/index', [
            'title' => 'Dataset Catalog',
            'datasets' => $datasets,
            'totalDatasets' => $totalDatasets,
            'search' => $search,
            'selectedDataType' => $dataType,
            'selectedCategory' => $category,
            'selectedFileFormat' => $fileFormat,
            'selectedDateUploaded' => $dateUploaded,
            'categories' => $categories ?: [],
            'formats' => $formats ?: [],
            'dateOptions' => $this->dateFilterOptions(),
            'statusLabels' => DatasetModel::statusLabels(),
            'accessOptions' => DatasetModel::accessOptions(),
            'pager' => $datasetModel->pager,
        ]);
    }

    public function show(int $id): string
    {
        $datasetModel = new DatasetModel();
        $dataset = $datasetModel
            ->select('datasets.*, users.name AS author_name')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.id', $id)
            ->first();

        if (! is_array($dataset) || ! $this->canViewDataset($dataset)) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (($dataset['status'] ?? '') === DatasetModel::STATUS_PUBLISHED) {
            model(DatasetViewModel::class)->insert([
                'dataset_id' => $id,
                'user_id' => $this->currentUserId(),
                'viewed_at' => date('Y-m-d H:i:s'),
                'ip_address' => $this->request->getIPAddress(),
            ]);
        }

        $latestFile = model(DatasetFileModel::class)
            ->where('dataset_id', $id)
            ->orderBy('created_at', 'DESC')
            ->first();

        $recommendations = $this->findRecommendations($dataset);

        return view('datasets/show', [
            'title' => $dataset['title'],
            'datasetId' => $id,
            'dataset' => $dataset,
            'latestFile' => $latestFile,
            'recommendations' => $recommendations,
            'viewCount' => $this->countDatasetEvents(new DatasetViewModel(), $id, 'viewed_at'),
            'downloadCount' => $this->countDatasetEvents(new DatasetDownloadModel(), $id, 'downloaded_at'),
            'canEdit' => $this->isAuthenticated() && $this->canManageDataset($dataset),
            'isOwner' => $this->isAuthenticated() && $this->canManageDataset($dataset),
            'statusLabel' => DatasetModel::statusLabel((string) ($dataset['status'] ?? '')),
            'accessLabel' => DatasetModel::accessLabel((string) ($dataset['access_type'] ?? '')),
        ]);
    }

    public function download(int $id)
    {
        $dataset = model(DatasetModel::class)->find($id);
        if (! is_array($dataset)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $canDownload = (($dataset['status'] ?? '') === DatasetModel::STATUS_PUBLISHED && ($dataset['archived_at'] ?? null) === null && $this->canAccessPublishedDataset($dataset))
            || ($this->isAuthenticated() && ($this->canManageDataset($dataset) || $this->hasRole('repository_administrator')));

        if (! $canDownload) {
            if (! $this->isAuthenticated() && ($dataset['access_type'] ?? DatasetModel::ACCESS_PUBLIC) !== DatasetModel::ACCESS_PUBLIC) {
                return redirect()
                    ->to('/login')
                    ->with('error', 'Please log in to access this dataset.');
            }

            return redirect()
                ->to('/datasets')
                ->with('error', 'That dataset is not available for download.');
        }

        $latestFile = model(DatasetFileModel::class)
            ->where('dataset_id', $id)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (! is_array($latestFile)) {
            return redirect()
                ->to('/datasets/' . $id)
                ->with('error', 'No uploaded dataset file is available for this record yet.');
        }

        $absolutePath = WRITEPATH . str_replace('/', DIRECTORY_SEPARATOR, (string) $latestFile['file_path']);
        if (! is_file($absolutePath)) {
            return redirect()
                ->to('/datasets/' . $id)
                ->with('error', 'The dataset file record exists, but the file is missing from storage.');
        }

        model(DatasetDownloadModel::class)->insert([
            'dataset_id' => $id,
            'user_id' => $this->currentUserId(),
            'downloaded_at' => date('Y-m-d H:i:s'),
            'ip_address' => $this->request->getIPAddress(),
        ]);
        $this->recordAudit('dataset_download', 'dataset', $id, 'Dataset file download served.');

        return $this->response->download($absolutePath, null)->setFileName((string) $latestFile['original_name']);
    }

    public function edit(int $id): string
    {
        $datasetModel = new DatasetModel();
        $dataset = $datasetModel->find($id);

        if (! is_array($dataset)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (! $this->canManageDataset($dataset)) {
            return redirect()
                ->to('/datasets/' . $id)
                ->with('error', 'You are not allowed to edit this dataset.');
        }

        if (! DatasetModel::isRevisionStatus((string) ($dataset['status'] ?? '')) && ($dataset['status'] ?? '') !== DatasetModel::STATUS_PUBLISHED) {
            return redirect()->to('/dashboard')->with('error', 'This dataset is locked while moderation is active.');
        }

        return view('datasets/edit', [
            'title' => 'Edit Dataset',
            'datasetId' => $id,
            'dataset' => $dataset,
            'dataTypes' => ['Text', 'Image', 'Audio', 'Video', 'Tabular'],
            'sourceTypes' => ['Primary', 'Secondary'],
            'accessTypes' => DatasetModel::accessOptions(),
            'statusLabel' => DatasetModel::statusLabel((string) ($dataset['status'] ?? '')),
        ]);
    }

    public function update(int $id)
    {
        $datasetModel = new DatasetModel();
        $dataset = $datasetModel->find($id);

        if (! is_array($dataset)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (! $this->canManageDataset($dataset)) {
            return redirect()
                ->to('/datasets/' . $id)
                ->with('error', 'You are not allowed to update this dataset.');
        }

        if (! DatasetModel::isRevisionStatus((string) ($dataset['status'] ?? '')) && ($dataset['status'] ?? '') !== DatasetModel::STATUS_PUBLISHED) {
            return redirect()->to('/dashboard')->with('error', 'This dataset is locked while moderation is active.');
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'category' => 'required|max_length[120]',
            'tags' => 'required|max_length[255]',
            'data_type' => 'required|max_length[80]',
            'file_format' => 'required|max_length[30]',
            'research_title' => 'required|max_length[255]',
            'project_head' => 'required|max_length[150]',
            'source_type' => 'required|max_length[80]',
            'access_type' => 'required|in_list[public,institutional,restricted,private]',
        ];

        $uploadedFile = $this->request->getFile('dataset_file');
        if ($uploadedFile && $uploadedFile->isValid() && ! $uploadedFile->hasMoved()) {
            $rules['dataset_file'] = 'ext_in[dataset_file,zip]|max_size[dataset_file,10240]';
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $latestFile = model(DatasetFileModel::class)
            ->where('dataset_id', $id)
            ->orderBy('created_at', 'DESC')
            ->first();

        $fileRecordId = is_array($latestFile) ? (int) $latestFile['id'] : null;
        if ($uploadedFile && $uploadedFile->isValid() && ! $uploadedFile->hasMoved()) {
            $fileRecordId = $this->storeDatasetFile($id, $uploadedFile, (int) $this->currentUserId());
        }

        $newVersion = $this->incrementVersion((string) ($dataset['version'] ?? '1.0'));
        $newStatus = match ((string) ($dataset['status'] ?? '')) {
            DatasetModel::STATUS_TECHNICAL_REVISION => DatasetModel::STATUS_PENDING_TECHNICAL,
            DatasetModel::STATUS_ETHICS_REVISION, DatasetModel::STATUS_PUBLISHED => DatasetModel::STATUS_PENDING_ETHICS,
            default => (string) $dataset['status'],
        };

        $datasetModel->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'category' => trim((string) $this->request->getPost('category')),
            'tags' => trim((string) $this->request->getPost('tags')),
            'data_type' => trim((string) $this->request->getPost('data_type')),
            'file_format' => trim((string) $this->request->getPost('file_format')),
            'access_type' => trim((string) $this->request->getPost('access_type')),
            'research_title' => trim((string) $this->request->getPost('research_title')),
            'project_head' => trim((string) $this->request->getPost('project_head')),
            'members' => trim((string) $this->request->getPost('members')),
            'source_type' => trim((string) $this->request->getPost('source_type')),
            'source_link' => trim((string) $this->request->getPost('source_link')),
            'version' => $newVersion,
            'status' => $newStatus,
            'approved_at' => null,
            'approved_by' => null,
        ]);

        model(DatasetVersionModel::class)->insert([
            'dataset_id' => $id,
            'version' => $newVersion,
            'change_summary' => trim((string) $this->request->getPost('change_summary')) ?: 'Dataset metadata updated.',
            'dataset_file_id' => $fileRecordId,
            'created_by' => (int) $this->currentUserId(),
        ]);
        $this->recordAudit('dataset_update', 'dataset', $id, 'Dataset metadata was updated.');

        return redirect()
            ->to('/datasets/' . $id . '/edit')
            ->with('info', 'Dataset changes have been saved.');
    }

    public function archive(int $id)
    {
        $dataset = model(DatasetModel::class)->find($id);
        if (! is_array($dataset)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (! $this->canManageDataset($dataset)) {
            return redirect()
                ->to('/datasets/' . $id)
                ->with('error', 'You are not allowed to archive this dataset.');
        }

        if (DatasetModel::isUnderReview((string) ($dataset['status'] ?? ''))) {
            return redirect()->to('/dashboard')->with('error', 'A dataset cannot be archived while moderation is active.');
        }

        model(DatasetModel::class)->update($id, [
            'archived_from_status' => (string) ($dataset['status'] ?? DatasetModel::STATUS_PENDING_ETHICS),
            'status' => DatasetModel::STATUS_ARCHIVED,
            'archived_at' => date('Y-m-d H:i:s'),
        ]);
        $this->recordAudit('dataset_archive', 'dataset', $id, 'Dataset archived from normal browsing.');

        return redirect()
            ->to('/dashboard')
            ->with('info', 'Dataset archived successfully.');
    }

    private function storeDatasetFile(int $datasetId, object $uploadedFile, int $userId): int
    {
        $targetDir = WRITEPATH . 'uploads/datasets/' . $datasetId;
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $storedName = $uploadedFile->getRandomName();
        $uploadedFile->move($targetDir, $storedName);
        $relativePath = 'uploads/datasets/' . $datasetId . '/' . $storedName;

        return (int) model(DatasetFileModel::class)->insert([
            'dataset_id' => $datasetId,
            'stored_name' => $storedName,
            'original_name' => $uploadedFile->getClientName(),
            'file_path' => $relativePath,
            'file_size' => (int) $uploadedFile->getSize(),
            'file_type' => (string) $uploadedFile->getClientMimeType(),
            'uploaded_by' => $userId,
        ], true);
    }

    private function incrementVersion(string $currentVersion): string
    {
        if (preg_match('/^(\d+)\.(\d+)$/', $currentVersion, $matches) === 1) {
            return $matches[1] . '.' . ((int) $matches[2] + 1);
        }

        return '1.1';
    }

    private function countDatasetEvents(object $model, int $datasetId, string $dateField): int
    {
        return $model->where('dataset_id', $datasetId)->countAllResults();
    }

    /**
     * @param array<string, mixed> $dataset
     * @return array<int, array<string, mixed>>
     */
    private function findRecommendations(array $dataset): array
    {
        $candidates = model(DatasetModel::class)
            ->select('datasets.*, users.name AS author_name')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where('datasets.status', DatasetModel::STATUS_PUBLISHED)
            ->where('datasets.archived_at', null)
            ->where('datasets.id !=', (int) $dataset['id']);
        $this->applyPublishedAccessScope($candidates);

        $candidates = $candidates->findAll();

        $scored = [];
        foreach ($candidates as $candidate) {
            $score = metadata_similarity_score($dataset, $candidate);
            if ($score > 0) {
                $candidate['score'] = $score;
                $scored[] = $candidate;
            }
        }

        usort($scored, static fn (array $a, array $b): int => (int) $b['score'] <=> (int) $a['score']);

        return array_slice($scored, 0, 3);
    }

    /**
     * @param array<string, mixed> $dataset
     */
    private function canViewDataset(array $dataset): bool
    {
        if ($this->hasRole('repository_administrator')) {
            return true;
        }
        if ($this->isAuthenticated() && $this->canManageDataset($dataset)) {
            return true;
        }

        return (($dataset['status'] ?? '') === DatasetModel::STATUS_PUBLISHED)
            && (($dataset['archived_at'] ?? null) === null)
            && $this->canAccessPublishedDataset($dataset);
    }

    /**
     * @param array<string, mixed> $dataset
     */
    private function canAccessPublishedDataset(array $dataset): bool
    {
        $accessType = (string) ($dataset['access_type'] ?? DatasetModel::ACCESS_PUBLIC);

        if ($accessType === DatasetModel::ACCESS_PUBLIC) {
            return true;
        }

        if ($accessType === DatasetModel::ACCESS_PRIVATE) {
            return false;
        }

        return $this->isAuthenticated();
    }

    private function applyPublishedAccessScope(object $query): void
    {
        if (! $this->isAuthenticated()) {
            $query->where('datasets.access_type', DatasetModel::ACCESS_PUBLIC);

            return;
        }

        $query->groupStart()
            ->where('datasets.access_type', DatasetModel::ACCESS_PUBLIC)
            ->orWhere('datasets.access_type', DatasetModel::ACCESS_INSTITUTIONAL)
            ->orWhere('datasets.access_type', DatasetModel::ACCESS_RESTRICTED)
            ->groupEnd();
    }

    private function dateFilterCutoff(string $dateUploaded): ?string
    {
        return match ($dateUploaded) {
            'today' => date('Y-m-d 00:00:00'),
            'week' => date('Y-m-d 00:00:00', strtotime('-7 days')),
            'month' => date('Y-m-d 00:00:00', strtotime('-1 month')),
            'year' => date('Y-m-d 00:00:00', strtotime('-1 year')),
            default => null,
        };
    }

    /**
     * @return array<string, string>
     */
    private function dateFilterOptions(): array
    {
        return [
            'today' => 'Today',
            'week' => 'This Week',
            'month' => 'This Month',
            'year' => 'This Year',
        ];
    }
}
