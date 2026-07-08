<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Admin Dashboard</h1>
    <p class="muted">MVP admin area for user activation, dataset approval, and audit basics.</p>
    <div class="actions">
        <a class="button" href="<?= site_url('admin/users') ?>">Manage Users</a>
        <a class="button" href="<?= site_url('admin/datasets') ?>">Approve Datasets</a>
        <a class="button" href="<?= site_url('admin/audit-logs') ?>">Audit Logs</a>
    </div>
</section>
<?= $this->endSection() ?>
