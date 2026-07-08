<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_REVISION = 'revision';
    public const STATUS_ARCHIVED = 'archived';

    protected $table = 'datasets';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'title',
        'description',
        'category',
        'tags',
        'data_type',
        'file_format',
        'source_type',
        'source_link',
        'form',
        'research_title',
        'project_head',
        'members',
        'contributor_id',
        'status',
        'access_type',
        'version',
        'approved_by',
        'approved_at',
        'archived_at',
    ];
}
