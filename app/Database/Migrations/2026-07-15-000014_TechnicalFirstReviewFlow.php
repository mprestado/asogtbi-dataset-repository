<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TechnicalFirstReviewFlow extends Migration
{
    public function up(): void
    {
        $this->forge->modifyColumn('datasets', [
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'default' => 'pending_technical_review',
            ],
        ]);

        $assignedEthics = $this->db->table('reviews')
            ->select('dataset_id')
            ->where('stage', 'ethics')
            ->where('status', 'assigned')
            ->get()
            ->getResultArray();
        $assignedEthicsIds = array_values(array_unique(array_map(static fn (array $row): int => (int) ($row['dataset_id'] ?? 0), $assignedEthics)));

        $builder = $this->db->table('datasets')->where('status', 'pending_ethics_review');
        if ($assignedEthicsIds !== []) {
            $builder->whereNotIn('id', $assignedEthicsIds);
        }
        $builder->update(['status' => 'pending_technical_review']);
    }

    public function down(): void
    {
        $this->forge->modifyColumn('datasets', [
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 40,
                'default' => 'pending_ethics_review',
            ],
        ]);
    }
}
