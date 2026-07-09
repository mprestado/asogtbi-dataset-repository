<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MvpSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('roles')->insertBatch([
            ['name' => 'admin', 'description' => 'Repository administrator'],
            ['name' => 'user', 'description' => 'Authorized dataset user'],
        ]);

        $this->db->table('users')->insertBatch([
            [
                'name' => 'Demo Admin',
                'email' => 'admin@example.test',
                'password_hash' => password_hash('change-me', PASSWORD_DEFAULT),
                'status' => 'active',
            ],
            [
                'name' => 'Demo User',
                'email' => 'user@example.test',
                'password_hash' => password_hash('change-me', PASSWORD_DEFAULT),
                'status' => 'active',
            ],
        ]);

        $this->db->table('user_roles')->insertBatch([
            ['user_id' => 1, 'role_id' => 1],
            ['user_id' => 2, 'role_id' => 2],
        ]);

        $this->db->table('datasets')->insertBatch([
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
                'contributor_id' => 2,
                'status' => 'approved',
                'access_type' => 'public',
                'version' => '1.0',
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
                'contributor_id' => 2,
                'status' => 'approved',
                'access_type' => 'public',
                'version' => '1.0',
            ],
            [
                'title' => 'Pending Prototype Dataset',
                'description' => 'Sample pending dataset for admin approval testing.',
                'category' => 'Prototype',
                'tags' => 'prototype,pending',
                'data_type' => 'Tabular',
                'file_format' => 'ZIP',
                'source_type' => 'Secondary',
                'research_title' => 'Prototype Dataset Submission',
                'project_head' => 'Demo Adviser',
                'contributor_id' => 2,
                'status' => 'pending',
                'access_type' => 'public',
                'version' => '1.0',
            ],
        ]);

        $baseDir = WRITEPATH . 'uploads/datasets';
        if (! is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $emptyZip = base64_decode('UEsFBgAAAAAAAAAAAAAAAAAAAAAAAA==');

        $files = [
            1 => 'startup-survey-responses.zip',
            2 => 'innovation-program-interviews.zip',
            3 => 'pending-prototype-dataset.zip',
        ];

        foreach ($files as $datasetId => $fileName) {
            $datasetDir = $baseDir . DIRECTORY_SEPARATOR . $datasetId;
            if (! is_dir($datasetDir)) {
                mkdir($datasetDir, 0777, true);
            }

            file_put_contents($datasetDir . DIRECTORY_SEPARATOR . $fileName, $emptyZip);
        }

        $this->db->table('dataset_files')->insertBatch([
            [
                'dataset_id' => 1,
                'stored_name' => 'startup-survey-responses.zip',
                'original_name' => 'startup-survey-responses.zip',
                'file_path' => 'uploads/datasets/1/startup-survey-responses.zip',
                'file_size' => strlen((string) $emptyZip),
                'file_type' => 'application/zip',
                'uploaded_by' => 2,
            ],
            [
                'dataset_id' => 2,
                'stored_name' => 'innovation-program-interviews.zip',
                'original_name' => 'innovation-program-interviews.zip',
                'file_path' => 'uploads/datasets/2/innovation-program-interviews.zip',
                'file_size' => strlen((string) $emptyZip),
                'file_type' => 'application/zip',
                'uploaded_by' => 2,
            ],
            [
                'dataset_id' => 3,
                'stored_name' => 'pending-prototype-dataset.zip',
                'original_name' => 'pending-prototype-dataset.zip',
                'file_path' => 'uploads/datasets/3/pending-prototype-dataset.zip',
                'file_size' => strlen((string) $emptyZip),
                'file_type' => 'application/zip',
                'uploaded_by' => 2,
            ],
        ]);

        $this->db->table('dataset_versions')->insertBatch([
            [
                'dataset_id' => 1,
                'version' => '1.0',
                'change_summary' => 'Initial seeded dataset.',
                'dataset_file_id' => 1,
                'created_by' => 2,
            ],
            [
                'dataset_id' => 2,
                'version' => '1.0',
                'change_summary' => 'Initial seeded dataset.',
                'dataset_file_id' => 2,
                'created_by' => 2,
            ],
            [
                'dataset_id' => 3,
                'version' => '1.0',
                'change_summary' => 'Initial seeded dataset.',
                'dataset_file_id' => 3,
                'created_by' => 2,
            ],
        ]);
    }
}
