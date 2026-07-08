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
    }
}
