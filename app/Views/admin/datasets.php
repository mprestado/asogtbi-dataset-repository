<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>
<header class="portal-heading"><p class="eyebrow">Administrator Queue</p><h1>Dataset moderation</h1><p>Assign technical verification first, then ethics review after the protected package passes file checks.</p></header>
<div class="portal-stack">
<?php foreach ($datasets as $dataset): ?>
    <article class="panel moderation-card">
        <div class="panel-head"><div><span class="status-pill status-<?= esc($dataset['status']) ?>"><?= esc($statusLabels[$dataset['status']] ?? $dataset['status']) ?></span><h2><?= esc($dataset['title']) ?></h2><p class="muted">Contributor: <?= esc($dataset['contributor_name'] ?? 'Unknown') ?> &middot; Version <?= esc($dataset['version']) ?></p></div><a class="button secondary" href="<?= site_url('admin/datasets/' . $dataset['id']) ?>">Inspect in portal</a></div>
        <?php if ($dataset['status'] === 'pending_technical_review'): ?>
            <form class="inline-admin-form" method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/assign') ?>"><?= csrf_field() ?><input type="hidden" name="stage" value="technical"><label>Technical reviewer<select name="reviewer_id" required><option value="">Select reviewer</option><?php foreach ($technicalReviewers as $reviewer): ?><option value="<?= esc($reviewer['id']) ?>"><?= esc($reviewer['name']) ?></option><?php endforeach; ?></select></label><button class="button" type="submit">Assign technical review</button></form>
        <?php elseif ($dataset['status'] === 'pending_ethics_review'): ?>
            <form class="inline-admin-form" method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/assign') ?>"><?= csrf_field() ?><input type="hidden" name="stage" value="ethics"><label>Ethics reviewer<select name="reviewer_id" required><option value="">Select reviewer</option><?php foreach ($ethicsReviewers as $reviewer): ?><option value="<?= esc($reviewer['id']) ?>"><?= esc($reviewer['name']) ?></option><?php endforeach; ?></select></label><button class="button" type="submit">Assign ethics review</button></form>
        <?php elseif ($dataset['status'] === 'awaiting_publication'): ?>
            <form class="inline-admin-form" method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/publish') ?>"><?= csrf_field() ?><label>Final access type<select name="access_type"><?php foreach ($accessOptions as $value => $label): ?><option value="<?= esc($value) ?>" <?= $dataset['access_type'] === $value ? 'selected' : '' ?>><?= esc($label) ?></option><?php endforeach; ?></select></label><button class="button" type="submit">Publish dataset</button></form>
        <?php endif; ?>
        <details class="review-history"><summary>Review history (<?= count($reviewsByDataset[(int) $dataset['id']] ?? []) ?>)</summary><?php foreach ($reviewsByDataset[(int) $dataset['id']] ?? [] as $review): ?><p><strong><?= esc(ucfirst($review['stage'])) ?> round <?= esc($review['review_round']) ?>:</strong> <?= esc($review['status']) ?> by <?= esc($review['reviewer_name'] ?? 'Unknown') ?><?= $review['comments'] ? ' · ' . esc($review['comments']) : '' ?></p><?php endforeach; ?></details>
        <form class="archive-form" method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/' . ($dataset['status'] === 'archived' ? 'restore' : 'archive')) ?>"><?= csrf_field() ?><button class="text-button" type="submit"><?= $dataset['status'] === 'archived' ? 'Restore dataset' : 'Archive dataset' ?></button></form>
    </article>
<?php endforeach; ?>
</div>
<?= $this->endSection() ?>
