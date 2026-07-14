<?= $this->extend('layouts/portal') ?>

<?= $this->section('content') ?>
<header class="portal-heading">
    <p class="eyebrow">Administrator Inspection</p>
    <h1><?= esc($dataset['title']) ?></h1>
    <p><?= esc($statusLabel) ?> &middot; <?= esc($accessLabel) ?> &middot; Version <?= esc($dataset['version'] ?? '1.0') ?></p>
</header>

<div class="review-layout">
    <section class="panel">
        <h2>Submission metadata</h2>
        <dl class="detail-list">
            <div><dt>Contributor</dt><dd><?= esc($dataset['contributor_name'] ?? 'Unknown') ?> &middot; <?= esc($dataset['contributor_email'] ?? '') ?></dd></div>
            <div><dt>Description</dt><dd><?= esc($dataset['description']) ?></dd></div>
            <div><dt>Research title</dt><dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd></div>
            <div><dt>Project head</dt><dd><?= esc($dataset['project_head'] ?: 'Not set') ?></dd></div>
            <div><dt>Authors</dt><dd><?= esc($dataset['members'] ?: 'Not listed') ?></dd></div>
            <div><dt>Category and type</dt><dd><?= esc($dataset['category'] ?: 'Uncategorized') ?> &middot; <?= esc($dataset['data_type'] ?: 'Dataset') ?> &middot; <?= esc($dataset['file_format'] ?: 'ZIP') ?></dd></div>
            <div><dt>Source</dt><dd><?= esc($dataset['source_type'] ?: 'Not set') ?><?= ! empty($dataset['source_link']) ? ' &middot; ' . esc($dataset['source_link']) : '' ?></dd></div>
            <div><dt>Tags</dt><dd><?= esc($dataset['tags'] ?: 'No tags') ?></dd></div>
        </dl>
    </section>

    <aside class="panel">
        <h2>Portal controls</h2>
        <p class="muted">This page is the administrator inspection surface. Website preview is an explicit exit.</p>
        <div class="actions">
            <a class="button secondary" href="<?= site_url('admin/datasets') ?>">Back to moderation</a>
            <a class="button portal-exit-action" href="<?= site_url('datasets/' . $dataset['id']) ?>">Return to website preview</a>
        </div>
        <?php if ($latestFile): ?>
            <dl class="detail-list portal-detail-mini">
                <div><dt>Current file</dt><dd><?= esc($latestFile['original_name']) ?></dd></div>
                <div><dt>Size</dt><dd><?= esc(number_format((int) $latestFile['file_size'])) ?> bytes</dd></div>
            </dl>
        <?php endif; ?>
    </aside>
</div>

<section class="panel">
    <h2>Review history</h2>
    <?php if (empty($reviews)): ?>
        <p class="muted">No review records have been created for this dataset yet.</p>
    <?php else: ?>
        <div class="portal-stack">
            <?php foreach ($reviews as $review): ?>
                <p><strong><?= esc(ucfirst($review['stage'])) ?> round <?= esc($review['review_round']) ?></strong> &middot; <?= esc($review['status']) ?> &middot; <?= esc($review['reviewer_name'] ?? 'Unknown') ?><?= $review['comments'] ? '<br>' . esc($review['comments']) : '' ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section class="panel">
    <h2>Version history</h2>
    <?php if (empty($versions)): ?>
        <p class="muted">No version history recorded yet.</p>
    <?php else: ?>
        <div class="portal-stack">
            <?php foreach ($versions as $version): ?>
                <p><strong>v<?= esc($version['version']) ?></strong> &middot; <?= esc($version['change_summary'] ?: 'No summary') ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
