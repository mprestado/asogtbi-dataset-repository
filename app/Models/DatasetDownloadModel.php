<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetDownloadModel extends Model
{
    protected $table = 'dataset_downloads';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = ['dataset_id', 'user_id', 'downloaded_at', 'ip_address'];
}
