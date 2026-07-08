<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatasetVersions extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'dataset_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'version' => ['type' => 'VARCHAR', 'constraint' => 20],
            'change_summary' => ['type' => 'TEXT', 'null' => true],
            'dataset_file_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dataset_id', 'datasets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('dataset_file_id', 'dataset_files', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dataset_versions');
    }

    public function down(): void
    {
        $this->forge->dropTable('dataset_versions');
    }
}
