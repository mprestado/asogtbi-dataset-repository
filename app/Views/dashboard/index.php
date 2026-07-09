<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <p class="eyebrow">Workspace Overview</p>
    <h1>Dataset Repository Dashboard</h1>
    <p class="lead">Track the MVP-ready repository flow across authentication, dataset submission, approval, discovery, citation, and download windows.</p>
    <div class="actions">
        <a class="button" href="<?= site_url('datasets') ?>">Browse Catalog</a>
        <a class="button secondary" href="<?= site_url('upload') ?>">Submit Dataset</a>
        <a class="button secondary" href="<?= site_url('admin') ?>">Open Admin</a>
    </div>
</section>

<section class="shell grid">
    <article class="panel stat-card">
        <p class="tag">Approved</p>
        <h2 class="stat-value"><?= esc((string) ($approvedCount ?? 0)) ?></h2>
        <p class="muted">Published datasets currently visible in normal browsing.</p>
    </article>
    <article class="panel stat-card">
        <p class="tag">Pending</p>
        <h2 class="stat-value"><?= esc((string) ($pendingCount ?? 0)) ?></h2>
        <p class="muted">Submitted datasets waiting for administrative review.</p>
    </article>
    <article class="panel stat-card">
        <p class="tag">Users</p>
        <h2 class="stat-value"><?= esc((string) ($userCount ?? 0)) ?></h2>
        <p class="muted">Seeded account records available for MVP walkthroughs.</p>
    </article>
</section>

<section class="shell split-grid">
    <article class="panel">
        <div class="panel-head">
            <div>
                <p class="tag">MVP Flow</p>
                <h2>Current repository responsibilities</h2>
            </div>
            <p class="muted">Aligned to the MVP scope and system skeleton docs.</p>
        </div>
        <ul class="stack-list">
            <?php foreach (($mvpAreas ?? []) as $area): ?>
                <li><?= esc($area) ?></li>
            <?php endforeach; ?>
        </ul>
    </article>

    <article class="panel">
        <div class="panel-head">
            <div>
                <p class="tag">Recent Records</p>
                <h2>Newest dataset entries</h2>
            </div>
        </div>
        <?php if (empty($recentDatasets)): ?>
            <p class="muted">No dataset records are available yet.</p>
        <?php else: ?>
            <ul class="record-list">
                <?php foreach ($recentDatasets as $dataset): ?>
                    <li>
                        <strong><?= esc($dataset['title']) ?></strong>
                        <span class="muted"><?= esc($dataset['category'] ?: 'Uncategorized') ?> · <?= esc($dataset['status']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </article>
</section>
<?= $this->endSection() ?>
