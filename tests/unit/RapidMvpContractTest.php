<?php

use App\Models\DatasetModel;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class RapidMvpContractTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        helper(['citation', 'recommendation']);
    }

    public function testDatasetStatusLabelsMatchPublicSiteLifecycle(): void
    {
        $this->assertSame([
            DatasetModel::STATUS_PENDING_ETHICS => 'Pending Ethics Review',
            DatasetModel::STATUS_ETHICS_REVISION => 'Ethics Revision Requested',
            DatasetModel::STATUS_PENDING_TECHNICAL => 'Pending Technical Review',
            DatasetModel::STATUS_TECHNICAL_REVISION => 'Technical Revision Requested',
            DatasetModel::STATUS_AWAITING_PUBLICATION => 'Awaiting Publication',
            DatasetModel::STATUS_PUBLISHED => 'Published',
            DatasetModel::STATUS_ARCHIVED => 'Archived',
            DatasetModel::STATUS_REJECTED => 'Rejected',
        ], DatasetModel::statusLabels());
    }

    public function testAccessOptionsRemainStableAcrossPublicationWorkflow(): void
    {
        $this->assertSame([
            DatasetModel::ACCESS_PUBLIC => 'Public',
            DatasetModel::ACCESS_INSTITUTIONAL => 'Institutional',
            DatasetModel::ACCESS_RESTRICTED => 'Restricted',
            DatasetModel::ACCESS_PRIVATE => 'Private',
        ], DatasetModel::accessOptions());
    }

    public function testCitationUsesRepositoryPublisher(): void
    {
        $citation = dataset_citation([
            'title' => 'Sample Data',
            'author' => 'ASOG TBI',
            'year' => '2026',
        ]);

        $this->assertSame('ASOG TBI. (2026). Sample Data. ASOG TBI Dataset Repository.', $citation);
    }

    public function testRecommendationScoreRewardsSharedMetadata(): void
    {
        $score = metadata_similarity_score([
            'category' => 'Analytics',
            'data_type' => 'Tabular',
            'file_format' => 'CSV',
            'tags' => 'incubator, startup, jobs',
            'description' => 'Startup incubation analytics dataset',
        ], [
            'category' => 'Analytics',
            'data_type' => 'Tabular',
            'file_format' => 'CSV',
            'tags' => 'startup, funding, jobs',
            'description' => 'Startup analytics funding dataset',
        ]);

        $this->assertGreaterThanOrEqual(70, $score);
    }
}
