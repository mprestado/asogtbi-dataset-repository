<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <span class="eyebrow">Two-week MVP head start</span>
    <h1><?= esc($title ?? 'ASOG TBI Dataset Repository') ?></h1>
    <p class="lead">A focused CodeIgniter 4 skeleton for publishing, reviewing, discovering, citing, downloading, and recommending institutional datasets.</p>
    <div class="actions">
        <a class="button" href="<?= site_url('datasets') ?>">Browse Datasets</a>
        <a class="button secondary" href="<?= site_url('upload') ?>">Submit Dataset</a>
    </div>
    <div class="metrics-grid">
        <div class="metric-card">
            <strong>6</strong>
            <span>parallel member lanes</span>
        </div>
        <div class="metric-card">
            <strong>10</strong>
            <span>working-day MVP plan</span>
        </div>
        <div class="metric-card">
            <strong>9</strong>
            <span>MVP database tables</span>
        </div>
    </div>
</section>

<div class="section-heading">
    <h2>Core Workstreams</h2>
</div>
<section class="grid">
    <div class="panel">
        <span class="tag">Catalog</span>
        <h3>Dataset Discovery</h3>
        <p class="muted">Catalog, search, filtering, detail pages, download, and recommendations.</p>
        <a class="button secondary" href="<?= site_url('datasets') ?>">Open Catalog</a>
    </div>
    <div class="panel">
        <span class="tag">Submission</span>
        <h3>Dataset Upload</h3>
        <p class="muted">Metadata form, ZIP validation, pending status, and protected storage.</p>
        <a class="button secondary" href="<?= site_url('upload') ?>">Upload Dataset</a>
    </div>
    <div class="panel">
        <span class="tag">Review</span>
        <h3>Admin Approval</h3>
        <p class="muted">User activation, dataset approval, and basic audit logs.</p>
        <a class="button secondary" href="<?= site_url('admin') ?>">Open Admin</a>
    </div>
</section>
<?= $this->endSection() ?>
