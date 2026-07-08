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
<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="<?= site_url('/') ?>" aria-label="ASOG TBI Dataset Repository home">
            <span class="brand-mark">ASOG</span>
            <span>
                <strong>TBI Dataset Repository</strong>
                <small>Research data for incubation and innovation</small>
            </span>
        </a>
        <nav class="nav-links" aria-label="Primary navigation">
            <a href="<?= site_url('/') ?>">Home</a>
            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('datasets') ?>">Datasets</a>
            <a href="<?= site_url('upload') ?>">Upload</a>
            <a href="<?= site_url('admin') ?>">Admin</a>
            <a class="nav-cta" href="<?= site_url('login') ?>">Login</a>
        </nav>
    </div>
</header>
<main class="container page-shell">
    <?php if (session()->getFlashdata('info')): ?>
        <div class="notice"><?= esc(session()->getFlashdata('info')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="notice error"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>
<footer class="site-footer">
    <div class="container footer-inner">
        <span>ASOG TBI Dataset Repository MVP</span>
        <span>CodeIgniter 4 + MySQL</span>
    </div>
</footer>
</body>
</html>
