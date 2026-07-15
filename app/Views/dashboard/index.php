<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Contributor Workspace</p>
        <h1>My Datasets</h1>
        <p class="lead">Track your submissions, continue revisions, and archive datasets that should leave the catalog.</p>
        <div class="actions">
            <a class="button gold" href="<?= site_url('upload') ?>">Upload Dataset</a>
            <a class="button secondary" href="<?= site_url('datasets') ?>">Browse Catalog</a>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="shell grid">
        <article class="panel stat-card">
            <p class="tag">Published</p>
            <h2 class="stat-value"><?= esc((string) (($statusCounts['published'] ?? 0))) ?></h2>
            <p class="muted">Your datasets currently visible in the public catalog.</p>
        </article>
        <article class="panel stat-card">
            <p class="tag">Pending Review</p>
            <h2 class="stat-value"><?= esc((string) (($statusCounts['pending'] ?? 0))) ?></h2>
            <p class="muted">Submissions moving through technical verification, ethics review, or publication approval.</p>
        </article>
        <article class="panel stat-card">
            <p class="tag">Revision Requested</p>
            <h2 class="stat-value"><?= esc((string) (($statusCounts['needsRevision'] ?? 0))) ?></h2>
            <p class="muted">Records that need contributor changes before another review.</p>
        </article>
    </div>
</section>

<?php if (! empty($notifications)): ?>
<section class="shell content-section">
    <div class="panel-head"><div><p class="tag">Repository updates</p><h2>Notifications</h2></div><form method="post" action="<?= site_url('dashboard/notifications/read') ?>"><?= csrf_field() ?><button class="button secondary" type="submit">Mark all read</button></form></div>
    <div class="portal-stack">
        <?php foreach ($notifications as $notification): ?><article class="panel <?= empty($notification['read_at']) ? 'notification-unread' : '' ?>"><h3><?= esc($notification['title']) ?></h3><p><?= esc($notification['message']) ?></p><?php if ($notification['link']): ?><a href="<?= site_url(ltrim($notification['link'], '/')) ?>">Open related record</a><?php endif; ?></article><?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<section class="shell content-section">
    <div class="panel-head">
        <div>
            <p class="tag">Submissions</p>
            <h2>Your dataset records</h2>
        </div>
    </div>

    <?php if (empty($myDatasets)): ?>
        <article class="panel dashboard-empty-state">
            <p class="tag">Upload Datasets</p>
            <h2>Upload your first dataset</h2>
            <p class="muted">Add a ZIP package and metadata record to start ethics review. You can track review status, revision comments, access type, and publication progress here after submission.</p>
            <div class="actions">
                <a class="button" href="<?= site_url('upload') ?>">Upload Dataset</a>
                <a class="button secondary" href="<?= site_url('datasets') ?>">Browse Catalog</a>
            </div>
        </article>
    <?php else: ?>
        <div class="submission-grid">
            <?php foreach ($myDatasets as $dataset): ?>
                <?php $latestReview = is_array($dataset['latestReview'] ?? null) ? $dataset['latestReview'] : null; ?>
                <?php $nextAction = is_array($dataset['nextAction'] ?? null) ? $dataset['nextAction'] : ['label' => 'Open this record to review its current state.', 'url' => null, 'tone' => 'neutral']; ?>
                <article class="dataset-card submission-card">
                    <div class="submission-card-top">
                        <span class="badge"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                        <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>">
                            <?= esc($dataset['statusLabel'] ?? ($statusLabels[$dataset['status'] ?? ''] ?? 'Unknown')) ?>
                        </span>
                        <span class="access-pill access-<?= esc($dataset['access_type'] ?? 'public') ?>">
                            <?php if (in_array(($dataset['access_type'] ?? ''), [\App\Models\DatasetModel::ACCESS_RESTRICTED, \App\Models\DatasetModel::ACCESS_PRIVATE], true)): ?>
                                <span class="material-symbols-rounded" aria-hidden="true">lock</span>
                            <?php endif; ?>
                            <?= esc($dataset['accessLabel'] ?? 'Public') ?>
                        </span>
                    </div>

                    <div class="submission-card-body">
                        <h3><?= esc($dataset['title']) ?></h3>
                        <p><?= esc($dataset['description']) ?></p>
                    </div>

                    <dl class="submission-meta">
                        <div>
                            <dt>Owner</dt>
                            <dd><?= esc($dataset['ownershipLabel'] ?? 'You own this submission') ?></dd>
                        </div>
                        <div>
                            <dt>Category</dt>
                            <dd><?= esc($dataset['category'] ?: 'Uncategorized') ?></dd>
                        </div>
                        <div>
                            <dt>Version</dt>
                            <dd><?= esc($dataset['version'] ?? '1.0') ?></dd>
                        </div>
                        <div>
                            <dt>Workflow</dt>
                            <dd><?= esc($dataset['statusLabel'] ?? 'Unknown') ?></dd>
                        </div>
                    </dl>

                    <?php if ($latestReview && trim((string) ($latestReview['comments'] ?? '')) !== ''): ?>
                        <aside class="revision-callout">
                            <p class="tag"><?= \App\Models\DatasetModel::isRevisionStatus($dataset['status'] ?? '') ? 'Needs revision' : 'Reviewer comments' ?></p>
                            <h4><?= esc(ucfirst((string) ($latestReview['stage'] ?? 'Review'))) ?> reviewer comments</h4>
                            <p><?= esc($latestReview['comments']) ?></p>
                        </aside>
                    <?php endif; ?>

                    <div class="next-action next-action-<?= esc($nextAction['tone'] ?? 'neutral') ?>">
                        <span class="material-symbols-rounded" aria-hidden="true"><?= ($nextAction['url'] ?? null) ? 'arrow_forward' : 'info' ?></span>
                        <div>
                            <strong>Next action</strong>
                            <p><?= esc($nextAction['label'] ?? 'Open this record to review its current state.') ?></p>
                        </div>
                    </div>

                    <div class="submission-actions">
                        <a class="button secondary" href="<?= site_url('datasets/' . $dataset['id']) ?>">View</a>
                        <?php if (! empty($dataset['canEdit'])): ?>
                            <a class="button" href="<?= site_url('datasets/' . $dataset['id'] . '/edit') ?>"><?= ($dataset['status'] ?? '') === \App\Models\DatasetModel::STATUS_PUBLISHED ? 'Submit update' : 'Revise dataset' ?></a>
                        <?php endif; ?>
                        <?php if (! empty($dataset['canArchive'])): ?>
                            <form class="submission-archive-form" method="post" action="<?= site_url('datasets/' . $dataset['id'] . '/archive') ?>">
                                <?= csrf_field() ?>
                                <button class="button secondary" type="submit">Archive</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
