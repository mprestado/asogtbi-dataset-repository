<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Repository Portal') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="portal-body">
<?php $roles = (array) session()->get('roles'); ?>
<div class="portal-frame">
    <aside class="portal-sidebar">
        <a class="portal-brand" href="<?= site_url('dashboard') ?>">
            <img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI">
            <span>Repository Governance</span>
        </a>
        <nav class="portal-nav" aria-label="Portal navigation">
            <a href="<?= site_url('dashboard') ?>">Contributor dashboard</a>
            <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>">Ethics reviews</a><?php endif; ?>
            <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>">Technical reviews</a><?php endif; ?>
            <?php if (in_array('repository_administrator', $roles, true)): ?>
                <a href="<?= site_url('admin') ?>">Admin overview</a>
                <a href="<?= site_url('admin/datasets') ?>">Dataset moderation</a>
                <a href="<?= site_url('admin/users') ?>">Users and roles</a>
                <a href="<?= site_url('admin/audit-logs') ?>">Audit logs</a>
            <?php endif; ?>
            <a href="<?= site_url('datasets') ?>">Public catalog</a>
        </nav>
        <div class="portal-account">
            <strong><?= esc((string) session()->get('user_name')) ?></strong>
            <small><?= esc(implode(', ', $roles)) ?></small>
            <form method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="button secondary" type="submit">Logout</button></form>
        </div>
    </aside>
    <main class="portal-main">
        <?php if (session()->getFlashdata('info')): ?><div class="notice"><?= esc(session()->getFlashdata('info')) ?></div><?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?><div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div><?php endif; ?>
        <?= $this->renderSection('content') ?>
    </main>
</div>
</body>
</html>
