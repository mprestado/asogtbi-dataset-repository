<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'ASOG TBI Dataset Repository') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
<?php
    $isAuthenticated = (bool) session()->get('user_id');
    $currentRole = (string) (session()->get('role') ?? '');
?>
<header class="site-header">
    <div class="shell header-inner">
        <nav class="nav-links nav-left" aria-label="Primary navigation left">
            <a href="<?= site_url('/') ?>">Home</a>
            <a href="<?= site_url('datasets') ?>">Browse</a>
            <?php if ($isAuthenticated): ?>
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a href="<?= site_url('upload') ?>">Upload</a>
            <?php endif; ?>
        </nav>
        <a class="brand" href="<?= site_url('/') ?>" aria-label="ASOG TBI Dataset Repository home">
            <span class="brand-mark" aria-hidden="true"></span>
            <span>
                <small>DOST-SEI PTP</small>
                <strong>ASOG</strong>
            </span>
        </a>
        <nav class="nav-links nav-right" aria-label="Primary navigation right">
            <?php if ($currentRole === 'admin'): ?>
                <a href="<?= site_url('admin') ?>">Admin</a>
            <?php endif; ?>
            <?php if ($isAuthenticated): ?>
                <span><?= esc((string) session()->get('user_name')) ?></span>
                <form method="post" action="<?= site_url('logout') ?>">
                    <?= csrf_field() ?>
                    <button class="nav-cta" type="submit">Logout</button>
                </form>
            <?php else: ?>
                <a class="nav-cta" href="<?= site_url('login') ?>">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="page-shell">
    <div class="shell flash-shell">
        <?php if (session()->getFlashdata('info')): ?>
            <div class="notice"><?= esc(session()->getFlashdata('info')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>
    </div>
    <?= $this->renderSection('content') ?>
</main>
<footer class="site-footer">
</footer>
</body>
</html>
