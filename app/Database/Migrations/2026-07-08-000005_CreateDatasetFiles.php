<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatasetFiles extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'dataset_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'stored_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'original_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_size' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'file_type' => ['type' => 'VARCHAR', 'constraint' => 80],
            'uploaded_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dataset_id', 'datasets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('uploaded_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dataset_files');
    }

    public function down(): void
    {
        $this->forge->dropTable('dataset_files');
    }
}
