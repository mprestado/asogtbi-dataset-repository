<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Repository Portal') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon/android-chrome-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="512x512" href="<?= base_url('favicon/android-chrome-512x512.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon/apple-touch-icon.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..24,400,0,0&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="portal-body">
<?php
    $roles = (array) session()->get('roles');
    $portalHome = in_array('repository_administrator', $roles, true)
        ? site_url('admin')
        : (in_array('ethics_reviewer', $roles, true) ? site_url('review/ethics') : (in_array('technical_reviewer', $roles, true) ? site_url('review/technical') : site_url('portal/dashboard')));
?>
<div class="portal-frame">
    <aside class="portal-sidebar">
        <a class="portal-brand" href="<?= $portalHome ?>">
            <img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI">
            <span>Repository Governance</span>
        </a>
        <nav class="portal-nav" aria-label="Portal navigation">
            <a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Contributor records</a>
            <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
            <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
            <?php if (in_array('repository_administrator', $roles, true)): ?>
                <a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin overview</a>
                <a href="<?= site_url('admin/datasets') ?>"><span class="material-symbols-rounded" aria-hidden="true">rule_settings</span> Dataset moderation</a>
                <a href="<?= site_url('admin/users') ?>"><span class="material-symbols-rounded" aria-hidden="true">group</span> Users and roles</a>
                <a href="<?= site_url('admin/audit-logs') ?>"><span class="material-symbols-rounded" aria-hidden="true">manage_search</span> Audit logs</a>
            <?php endif; ?>
        </nav>
        <div class="portal-account">
            <details class="portal-account-menu">
                <summary>
                    <span class="material-symbols-rounded" aria-hidden="true">account_circle</span>
                    <span>Account</span>
                </summary>
                <div>
                    <strong><?= esc((string) session()->get('user_name')) ?></strong>
                    <small><?= esc(implode(', ', $roles)) ?></small>
                    <a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Contributor records</a>
                    <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
                    <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
                    <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin dashboard</a><?php endif; ?>
                    <form method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="button secondary" type="submit"><span class="material-symbols-rounded" aria-hidden="true">logout</span> Logout</button></form>
                </div>
            </details>
            <a class="button portal-return" href="<?= site_url('/') ?>"><span class="material-symbols-rounded" aria-hidden="true">open_in_new</span> Return to website</a>
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
