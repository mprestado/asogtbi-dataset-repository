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
        <article class="panel">
            <h2>No submissions yet</h2>
            <p class="muted">Upload your first dataset package to start technical verification.</p>
            <div class="actions">
                <a class="button" href="<?= site_url('upload') ?>">Upload Dataset</a>
            </div>
        </article>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($myDatasets as $dataset): ?>
                <article class="dataset-card">
                    <div class="badge-row">
                        <span class="badge"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                        <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>">
                            <?= esc(($statusLabels[$dataset['status'] ?? ''] ?? 'Unknown')) ?>
                        </span>
                    </div>
                    <h3><?= esc($dataset['title']) ?></h3>
                    <p><?= esc($dataset['description']) ?></p>
                    <dl class="meta-list">
                        <div>
                            <dt>Category</dt>
                            <dd><?= esc($dataset['category'] ?: 'Uncategorized') ?></dd>
                        </div>
                        <div>
                            <dt>Version</dt>
                            <dd><?= esc($dataset['version'] ?? '1.0') ?></dd>
                        </div>
                    </dl>
                    <div class="actions">
                        <a class="button secondary" href="<?= site_url('datasets/' . $dataset['id']) ?>">View</a>
                        <?php if (\App\Models\DatasetModel::isRevisionStatus($dataset['status'] ?? '') || ($dataset['status'] ?? '') === \App\Models\DatasetModel::STATUS_PUBLISHED): ?><a class="button" href="<?= site_url('datasets/' . $dataset['id'] . '/edit') ?>"><?= ($dataset['status'] ?? '') === \App\Models\DatasetModel::STATUS_PUBLISHED ? 'Submit update' : 'Revise' ?></a><?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
