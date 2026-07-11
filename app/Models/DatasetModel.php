<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    public const STATUS_PENDING = 'pending_review';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_REVISION_REQUESTED = 'revision_requested';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_ARCHIVED = 'archived';

    public const ACCESS_PUBLIC = 'public';
    public const ACCESS_INSTITUTIONAL = 'institutional';
    public const ACCESS_RESTRICTED = 'restricted';
    public const ACCESS_PRIVATE = 'private';

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

    /**
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_PENDING => 'Pending Review',
            self::STATUS_REVISION_REQUESTED => 'Revision Requested',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_ARCHIVED => 'Archived',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public static function statusLabel(?string $status): string
    {
        return self::statusLabels()[$status ?? ''] ?? 'Unknown';
    }

    /**
     * @return array<string, string>
     */
    public static function accessOptions(): array
    {
        return [
            self::ACCESS_PUBLIC => 'Public',
            self::ACCESS_INSTITUTIONAL => 'Institutional',
            self::ACCESS_RESTRICTED => 'Restricted',
            self::ACCESS_PRIVATE => 'Private',
        ];
    }

    public static function accessLabel(?string $accessType): string
    {
        return self::accessOptions()[$accessType ?? ''] ?? 'Public';
    }
}
