<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetViewModel extends Model
{
    protected $table = 'dataset_views';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['dataset_id', 'user_id', 'viewed_at', 'ip_address'];
}
