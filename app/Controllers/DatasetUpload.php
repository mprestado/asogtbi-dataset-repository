<?php

namespace App\Controllers;

use App\Models\DatasetFileModel;
use App\Models\DatasetModel;
use App\Models\DatasetVersionModel;

class DatasetUpload extends BaseController
{
    public function create(): string
    {
        return view('upload/create', [
            'title' => 'Upload Dataset',
            'dataTypes' => ['Text', 'Image', 'Audio', 'Video', 'Tabular'],
            'sourceTypes' => ['Primary', 'Secondary'],
            'accessTypes' => DatasetModel::accessOptions(),
            'requiredMetadata' => [
                'Title',
                'Description',
                'Tags',
                'Category',
                'Data type',
                'File format',
                'Research title',
                'Project head or adviser',
                'Source type',
                'ZIP file',
            ],
        ]);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'category' => 'required|max_length[120]',
            'tags' => 'required|max_length[255]',
            'data_type' => 'required|max_length[80]',
            'file_format' => 'required|max_length[30]',
            'source_type' => 'required|max_length[80]',
            'research_title' => 'required|max_length[255]',
            'project_head' => 'required|max_length[150]',
            'access_type' => 'required|in_list[public,institutional,restricted,private]',
            'anonymized' => 'required',
            'dataset_file' => 'uploaded[dataset_file]|ext_in[dataset_file,zip]|max_size[dataset_file,10240]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $datasetModel = new DatasetModel();
        $fileModel = new DatasetFileModel();
        $versionModel = new DatasetVersionModel();

        $datasetId = (int) $datasetModel->insert([
            'title' => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'category' => trim((string) $this->request->getPost('category')),
            'tags' => trim((string) $this->request->getPost('tags')),
            'data_type' => trim((string) $this->request->getPost('data_type')),
            'file_format' => trim((string) $this->request->getPost('file_format')),
            'source_type' => trim((string) $this->request->getPost('source_type')),
            'source_link' => trim((string) $this->request->getPost('source_link')),
            'research_title' => trim((string) $this->request->getPost('research_title')),
            'project_head' => trim((string) $this->request->getPost('project_head')),
            'members' => trim((string) $this->request->getPost('members')),
            'contributor_id' => (int) $this->currentUserId(),
            'status' => DatasetModel::STATUS_PENDING,
            'access_type' => trim((string) $this->request->getPost('access_type')),
            'version' => '1.0',
        ], true);

        $uploadedFile = $this->request->getFile('dataset_file');
        $fileRecordId = $this->storeDatasetFile($datasetId, $uploadedFile, (int) $this->currentUserId());

        $versionModel->insert([
            'dataset_id' => $datasetId,
            'version' => '1.0',
            'change_summary' => 'Initial dataset submission.',
            'dataset_file_id' => $fileRecordId,
            'created_by' => (int) $this->currentUserId(),
        ]);

        $this->recordAudit('dataset_upload', 'dataset', $datasetId, 'Dataset submitted for technical verification.');

        return redirect()
            ->to('/datasets/' . $datasetId . '/edit')
            ->with('info', 'Dataset submitted successfully and is now pending technical verification.');
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
}
