<?php

use App\Models\DatasetModel;
use App\Models\ReviewModel;
use App\Services\ModerationWorkflow;
use CodeIgniter\Test\CIUnitTestCase;

final class ModerationWorkflowContractTest extends CIUnitTestCase
{
    public function testReviewStagesHaveDistinctRequiredChecklists(): void
    {
        $ethics = ModerationWorkflow::checklist(ReviewModel::STAGE_ETHICS);
        $technical = ModerationWorkflow::checklist(ReviewModel::STAGE_TECHNICAL);

        $this->assertArrayHasKey('anonymization', $ethics);
        $this->assertArrayHasKey('consent_clearance', $ethics);
        $this->assertArrayHasKey('archive_readable', $technical);
        $this->assertArrayHasKey('documentation_complete', $technical);
        $this->assertCount(5, $ethics);
        $this->assertCount(5, $technical);
    }

    public function testContributorRevisionStatesAreExplicit(): void
    {
        $this->assertTrue(DatasetModel::isRevisionStatus(DatasetModel::STATUS_ETHICS_REVISION));
        $this->assertTrue(DatasetModel::isRevisionStatus(DatasetModel::STATUS_TECHNICAL_REVISION));
        $this->assertFalse(DatasetModel::isRevisionStatus(DatasetModel::STATUS_REJECTED));
    }

    public function testActiveModerationStatesAreLocked(): void
    {
        $this->assertTrue(DatasetModel::isUnderReview(DatasetModel::STATUS_PENDING_ETHICS));
        $this->assertTrue(DatasetModel::isUnderReview(DatasetModel::STATUS_PENDING_TECHNICAL));
        $this->assertTrue(DatasetModel::isUnderReview(DatasetModel::STATUS_AWAITING_PUBLICATION));
        $this->assertFalse(DatasetModel::isUnderReview(DatasetModel::STATUS_PUBLISHED));
    }
}
