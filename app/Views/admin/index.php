<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <p class="eyebrow">Admin Workspace</p>
    <h1>Admin Dashboard</h1>
    <p class="lead">Use the administrative windows to activate users, review dataset submissions, and inspect audit-ready events needed for the MVP demo flow.</p>
    <div class="actions">
        <a class="button" href="<?= site_url('admin/users') ?>">Manage Users</a>
        <a class="button secondary" href="<?= site_url('admin/datasets') ?>">Review Datasets</a>
        <a class="button secondary" href="<?= site_url('admin/audit-logs') ?>">Audit Logs</a>
    </div>
</section>

<section class="shell grid">
    <article class="panel stat-card">
        <p class="tag">Users</p>
        <h2 class="stat-value"><?= esc((string) ($adminStats['activeUsers'] ?? 0)) ?></h2>
        <p class="muted">Active accounts visible to the repository administrator.</p>
    </article>
    <article class="panel stat-card">
        <p class="tag">Pending</p>
        <h2 class="stat-value"><?= esc((string) ($adminStats['pendingDatasets'] ?? 0)) ?></h2>
        <p class="muted">Datasets waiting for approval or rejection.</p>
    </article>
    <article class="panel stat-card">
        <p class="tag">Audits</p>
        <h2 class="stat-value"><?= esc((string) ($adminStats['auditEvents'] ?? 0)) ?></h2>
        <p class="muted">Recorded events currently stored in the audit log table.</p>
    </article>
</section>
<?= $this->endSection() ?>
