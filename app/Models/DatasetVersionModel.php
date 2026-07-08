<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetVersionModel extends Model
{
    protected $table = 'dataset_versions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'dataset_id',
        'version',
        'change_summary',
        'dataset_file_id',
        'created_by',
    ];
}
