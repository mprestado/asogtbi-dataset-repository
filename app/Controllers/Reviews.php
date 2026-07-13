<?php

namespace App\Controllers;

use App\Models\DatasetFileModel;
use App\Models\DatasetVersionModel;
use App\Models\ReviewModel;
use App\Services\ModerationWorkflow;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;

class Reviews extends BaseController
{
    public function index(string $stage): string
    {
        $this->assertStage($stage);
        $reviews = model(ReviewModel::class)
            ->select('reviews.*, datasets.title, datasets.status AS dataset_status, users.name AS contributor_name')
            ->join('datasets', 'datasets.id = reviews.dataset_id')
            ->join('users', 'users.id = datasets.contributor_id', 'left')
            ->where(['reviews.stage' => $stage, 'reviews.reviewer_id' => (int) $this->currentUserId()])
            ->where('reviews.status !=', ReviewModel::STATUS_REASSIGNED)
            ->orderBy('reviews.status', 'ASC')->orderBy('reviews.assigned_at', 'DESC')->findAll();

        return view('reviews/index', ['title' => ucfirst($stage) . ' Review Queue', 'stage' => $stage, 'reviews' => $reviews]);
    }

    public function show(string $stage, int $reviewId): string
    {
        $review = $this->assignedReview($stage, $reviewId);
        $dataset = db_connect()->table('datasets')->select('datasets.*, users.name AS contributor_name, users.email AS contributor_email')->join('users', 'users.id = datasets.contributor_id', 'left')->where('datasets.id', $review['dataset_id'])->get()->getRowArray();
        if (! is_array($dataset)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('reviews/show', [
            'title' => ucfirst($stage) . ' Review', 'stage' => $stage, 'review' => $review,
            'dataset' => $dataset, 'checklist' => ModerationWorkflow::checklist($stage),
            'latestFile' => model(DatasetFileModel::class)->where('dataset_id', $dataset['id'])->orderBy('id', 'DESC')->first(),
            'versions' => model(DatasetVersionModel::class)->where('dataset_id', $dataset['id'])->orderBy('id', 'DESC')->findAll(),
            'history' => model(ReviewModel::class)->select('reviews.*, users.name AS reviewer_name')->join('users', 'users.id = reviews.reviewer_id', 'left')->where('dataset_id', $dataset['id'])->orderBy('reviews.id', 'DESC')->findAll(),
        ]);
    }

    public function decide(string $stage, int $reviewId)
    {
        $this->assertStage($stage);
        try {
            (new ModerationWorkflow())->decide($reviewId, (int) $this->currentUserId(), trim((string) $this->request->getPost('decision')), (array) $this->request->getPost('checklist'), trim((string) $this->request->getPost('comments')), $this->request->getIPAddress());
        } catch (RuntimeException $exception) {
            return redirect()->back()->withInput()->with('error', $exception->getMessage());
        }

        return redirect()->to('/review/' . $stage)->with('info', 'Review decision recorded.');
    }

    public function download(string $stage, int $reviewId)
    {
        $review = $this->assignedReview($stage, $reviewId);
        $file = model(DatasetFileModel::class)->where('dataset_id', $review['dataset_id'])->orderBy('id', 'DESC')->first();
        if (! is_array($file)) {
            return redirect()->back()->with('error', 'No dataset file is available for this review.');
        }
        $path = WRITEPATH . str_replace('/', DIRECTORY_SEPARATOR, (string) $file['file_path']);
        if (! is_file($path)) {
            return redirect()->back()->with('error', 'The protected file is missing from storage.');
        }
        $this->recordAudit('review_file_download', 'review', $reviewId, 'Reviewer downloaded the protected submission file.');

        return $this->response->download($path, null)->setFileName((string) $file['original_name']);
    }

    private function assignedReview(string $stage, int $reviewId): array
    {
        $this->assertStage($stage);
        $review = model(ReviewModel::class)->where(['id' => $reviewId, 'stage' => $stage, 'reviewer_id' => (int) $this->currentUserId()])->where('status !=', ReviewModel::STATUS_REASSIGNED)->first();
        if (! is_array($review)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $review;
    }

    private function assertStage(string $stage): void
    {
        if (! in_array($stage, [ReviewModel::STAGE_ETHICS, ReviewModel::STAGE_TECHNICAL], true)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $role = $stage === ReviewModel::STAGE_ETHICS ? ModerationWorkflow::ROLE_ETHICS : ModerationWorkflow::ROLE_TECHNICAL;
        if (! $this->hasRole($role)) {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
