<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDatasetDownloads extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'dataset_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'downloaded_at' => ['type' => 'DATETIME'],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('dataset_id', 'datasets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('dataset_downloads');
    }

    public function down(): void
    {
        $this->forge->dropTable('dataset_downloads');
    }
}
