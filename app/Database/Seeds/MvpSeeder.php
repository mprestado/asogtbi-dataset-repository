<?php

namespace App\Database\Seeds;

use App\Models\DatasetModel;
use CodeIgniter\Database\Seeder;

class MvpSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');
        $roleId = $this->ensureRole($now);
        $userId = $this->ensureDemoUser($roleId, $now);

        $datasets = [
            [
                'title' => 'Startup Survey Responses',
                'description' => 'Sample tabular dataset for incubatee startup needs assessment.',
                'category' => 'Startup Research',
                'tags' => 'startup,survey,incubatee',
                'data_type' => 'Tabular',
                'file_format' => 'ZIP',
                'source_type' => 'Primary',
                'research_title' => 'ASOG TBI Startup Needs Assessment',
                'project_head' => 'Demo Adviser',
                'status' => DatasetModel::STATUS_PUBLISHED,
                'access_type' => DatasetModel::ACCESS_PUBLIC,
                'version' => '1.0',
                'file_name' => 'startup-survey-responses.zip',
            ],
            [
                'title' => 'Innovation Program Interviews',
                'description' => 'Sample text dataset containing coded interview excerpts.',
                'category' => 'Innovation',
                'tags' => 'innovation,interview,text',
                'data_type' => 'Text',
                'file_format' => 'ZIP',
                'source_type' => 'Primary',
                'research_title' => 'Innovation Program Review',
                'project_head' => 'Demo Adviser',
                'status' => DatasetModel::STATUS_PUBLISHED,
                'access_type' => DatasetModel::ACCESS_PUBLIC,
                'version' => '1.0',
                'file_name' => 'innovation-program-interviews.zip',
            ],
            [
                'title' => 'Pending Prototype Dataset',
                'description' => 'Sample pending dataset visible only to its contributor while the separate Admin Portal handles review.',
                'category' => 'Prototype',
                'tags' => 'prototype,pending',
                'data_type' => 'Tabular',
                'file_format' => 'ZIP',
                'source_type' => 'Secondary',
                'research_title' => 'Prototype Dataset Submission',
                'project_head' => 'Demo Adviser',
                'status' => DatasetModel::STATUS_PENDING,
                'access_type' => DatasetModel::ACCESS_PUBLIC,
                'version' => '1.0',
                'file_name' => 'pending-prototype-dataset.zip',
            ],
        ];

        foreach ($datasets as $dataset) {
            $datasetId = $this->ensureDataset($dataset, $userId, $now);
            $fileId = $this->ensureDatasetFile($datasetId, $userId, (string) $dataset['file_name'], $now);
            $this->ensureDatasetVersion($datasetId, $userId, $fileId, (string) $dataset['version'], $now);
        }
    }

    private function ensureRole(string $now): int
    {
        $role = $this->db->table('roles')->where('name', 'user')->get()->getRowArray();
        if (is_array($role)) {
            $this->db->table('roles')->where('id', (int) $role['id'])->update([
                'description' => 'Authorized dataset user',
                'updated_at' => $now,
            ]);

            return (int) $role['id'];
        }

        $this->db->table('roles')->insert([
            'name' => 'user',
            'description' => 'Authorized dataset user',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return (int) $this->db->insertID();
    }

    private function ensureDemoUser(int $roleId, string $now): int
    {
        $user = $this->db->table('users')->where('email', 'user@example.test')->get()->getRowArray();

        if (is_array($user)) {
            $userId = (int) $user['id'];
            $this->db->table('users')->where('id', $userId)->update([
                'name' => 'Demo User',
                'status' => 'active',
                'updated_at' => $now,
            ]);
        } else {
            $this->db->table('users')->insert([
                'name' => 'Demo User',
                'email' => 'user@example.test',
                'password_hash' => password_hash('change-me', PASSWORD_DEFAULT),
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $userId = (int) $this->db->insertID();
        }

        $userRole = $this->db->table('user_roles')
            ->where('user_id', $userId)
            ->where('role_id', $roleId)
            ->get()
            ->getRowArray();

        if (! is_array($userRole)) {
            $this->db->table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
        }

        return $userId;
    }

    /**
     * @param array<string, string> $dataset
     */
    private function ensureDataset(array $dataset, int $userId, string $now): int
    {
        $existing = $this->db->table('datasets')
            ->where('title', $dataset['title'])
            ->where('contributor_id', $userId)
            ->get()
            ->getRowArray();

        $record = [
            'title' => $dataset['title'],
            'description' => $dataset['description'],
            'category' => $dataset['category'],
            'tags' => $dataset['tags'],
            'data_type' => $dataset['data_type'],
            'file_format' => $dataset['file_format'],
            'source_type' => $dataset['source_type'],
            'research_title' => $dataset['research_title'],
            'project_head' => $dataset['project_head'],
            'contributor_id' => $userId,
            'status' => $dataset['status'],
            'access_type' => $dataset['access_type'],
            'version' => $dataset['version'],
            'approved_at' => $dataset['status'] === DatasetModel::STATUS_PUBLISHED ? $now : null,
            'updated_at' => $now,
        ];

        if (is_array($existing)) {
            $datasetId = (int) $existing['id'];
            $this->db->table('datasets')->where('id', $datasetId)->update($record);

            return $datasetId;
        }

        $record['created_at'] = $now;
        $this->db->table('datasets')->insert($record);

        return (int) $this->db->insertID();
    }

    private function ensureDatasetFile(int $datasetId, int $userId, string $fileName, string $now): int
    {
        $baseDir = WRITEPATH . 'uploads/datasets';
        $datasetDir = $baseDir . DIRECTORY_SEPARATOR . $datasetId;
        if (! is_dir($datasetDir)) {
            mkdir($datasetDir, 0777, true);
        }

        $emptyZip = base64_decode('UEsFBgAAAAAAAAAAAAAAAAAAAAAAAA==');
        $absolutePath = $datasetDir . DIRECTORY_SEPARATOR . $fileName;
        if (! is_file($absolutePath)) {
            file_put_contents($absolutePath, $emptyZip);
        }

        $relativePath = 'uploads/datasets/' . $datasetId . '/' . $fileName;
        $existing = $this->db->table('dataset_files')
            ->where('dataset_id', $datasetId)
            ->where('original_name', $fileName)
            ->get()
            ->getRowArray();

        $record = [
            'dataset_id' => $datasetId,
            'stored_name' => $fileName,
            'original_name' => $fileName,
            'file_path' => $relativePath,
            'file_size' => is_string($emptyZip) ? strlen($emptyZip) : 0,
            'file_type' => 'application/zip',
            'uploaded_by' => $userId,
            'updated_at' => $now,
        ];

        if (is_array($existing)) {
            $fileId = (int) $existing['id'];
            $this->db->table('dataset_files')->where('id', $fileId)->update($record);

            return $fileId;
        }

        $record['created_at'] = $now;
        $this->db->table('dataset_files')->insert($record);

        return (int) $this->db->insertID();
    }

    private function ensureDatasetVersion(int $datasetId, int $userId, int $fileId, string $version, string $now): void
    {
        $existing = $this->db->table('dataset_versions')
            ->where('dataset_id', $datasetId)
            ->where('version', $version)
            ->get()
            ->getRowArray();

        $record = [
            'dataset_id' => $datasetId,
            'version' => $version,
            'change_summary' => 'Initial seeded dataset.',
            'dataset_file_id' => $fileId,
            'created_by' => $userId,
            'updated_at' => $now,
        ];

        if (is_array($existing)) {
            $this->db->table('dataset_versions')->where('id', (int) $existing['id'])->update($record);

            return;
        }

        $record['created_at'] = $now;
        $this->db->table('dataset_versions')->insert($record);
    }
}
