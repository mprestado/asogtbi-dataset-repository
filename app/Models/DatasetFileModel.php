<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetFileModel extends Model
{
    protected $table = 'dataset_files';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'dataset_id',
        'stored_name',
        'original_name',
        'file_path',
        'file_size',
        'file_type',
        'uploaded_by',
    ];
}
