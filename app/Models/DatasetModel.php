<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    public const STATUS_PENDING = 'pending_ethics_review';
    public const STATUS_PENDING_ETHICS = 'pending_ethics_review';
    public const STATUS_ETHICS_REVISION = 'ethics_revision_requested';
    public const STATUS_PENDING_TECHNICAL = 'pending_technical_review';
    public const STATUS_TECHNICAL_REVISION = 'technical_revision_requested';
    public const STATUS_AWAITING_PUBLICATION = 'awaiting_publication';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_REVISION_REQUESTED = 'ethics_revision_requested';
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
        'archived_from_status',
    ];

    /**
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_PENDING_ETHICS => 'Pending Ethics Review',
            self::STATUS_ETHICS_REVISION => 'Ethics Revision Requested',
            self::STATUS_PENDING_TECHNICAL => 'Pending Technical Review',
            self::STATUS_TECHNICAL_REVISION => 'Technical Revision Requested',
            self::STATUS_AWAITING_PUBLICATION => 'Awaiting Publication',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_ARCHIVED => 'Archived',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    public static function isRevisionStatus(?string $status): bool
    {
        return in_array($status, [self::STATUS_ETHICS_REVISION, self::STATUS_TECHNICAL_REVISION], true);
    }

    public static function isUnderReview(?string $status): bool
    {
        return in_array($status, [self::STATUS_PENDING_ETHICS, self::STATUS_PENDING_TECHNICAL, self::STATUS_AWAITING_PUBLICATION], true);
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
