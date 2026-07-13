<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'ASOG TBI Dataset Repository') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800;900&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
<?php $isAuthenticated = (bool) session()->get('user_id'); ?>
<?php $roles = (array) session()->get('roles'); ?>
<header class="site-header" id="site-header">
    <div class="wide-shell header-inner">
        <a class="brand" href="<?= site_url('/') ?>" aria-label="ASOG TBI Dataset Repository home">
            <img class="brand-logo" src="<?= base_url('assets/img/cspc.png') ?>" alt="CSPC logo">
            <span class="brand-text">
                <strong>ASOG TBI Dataset Repository</strong>
                <small>CSPC research and innovation data</small>
            </span>
        </a>

        <nav class="nav-links" aria-label="Primary navigation">
            <a href="<?= site_url('/') ?>">Home</a>
            <a href="<?= site_url('datasets') ?>">Browse Datasets</a>
            <?php if ($isAuthenticated): ?>
                <a href="<?= site_url('dashboard') ?>">My Datasets</a>
                <a href="<?= site_url('upload') ?>">Upload</a>
                <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>">Ethics Portal</a><?php endif; ?>
                <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>">Technical Portal</a><?php endif; ?>
                <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>">Admin Portal</a><?php endif; ?>
            <?php endif; ?>
        </nav>

        <div class="nav-actions">
            <?php if ($isAuthenticated): ?>
                <span><?= esc((string) session()->get('user_name')) ?></span>
                <form class="nav-form" method="post" action="<?= site_url('logout') ?>">
                    <?= csrf_field() ?>
                    <button class="nav-cta" type="submit">Logout</button>
                </form>
            <?php else: ?>
                <a class="nav-cta" href="<?= site_url('login') ?>">Login</a>
            <?php endif; ?>
        </div>

        <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-controls="mobile-nav" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <nav class="wide-shell mobile-nav" id="mobile-nav" aria-label="Mobile navigation">
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('datasets') ?>">Browse Datasets</a>
        <?php if ($isAuthenticated): ?>
            <a href="<?= site_url('dashboard') ?>">My Datasets</a>
            <a href="<?= site_url('upload') ?>">Upload</a>
            <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>">Ethics Portal</a><?php endif; ?>
            <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>">Technical Portal</a><?php endif; ?>
            <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>">Admin Portal</a><?php endif; ?>
            <form class="nav-form" method="post" action="<?= site_url('logout') ?>">
                <?= csrf_field() ?>
                <button class="nav-cta" type="submit">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?= site_url('login') ?>">Login</a>
            <a href="<?= site_url('register') ?>">Register</a>
        <?php endif; ?>
    </nav>
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
    <div class="wide-shell">
        <div class="ft-grid">
            <section>
                <img class="ft-logo" src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI logo">
                <p class="ft-tagline">A public and user-facing dataset repository for CSPC and ASOG TBI research, thesis, capstone, analytics, AI/ML, and startup development work.</p>
            </section>

            <section>
                <h3 class="ft-heading">Quick Links</h3>
                <ul class="ft-links">
                    <li><a href="<?= site_url('/') ?>">Home</a></li>
                    <li><a href="<?= site_url('datasets') ?>">Browse Datasets</a></li>
                    <li><a href="<?= site_url('upload') ?>">Upload Dataset</a></li>
                    <li><a href="<?= site_url('dashboard') ?>">My Datasets</a></li>
                </ul>
            </section>

            <section>
                <h3 class="ft-heading">Repository</h3>
                <ul class="ft-links">
                    <li><a href="<?= site_url('datasets') ?>">Search Catalog</a></li>
                    <li><a href="<?= site_url('register') ?>">Create Account</a></li>
                    <li><a href="<?= site_url('login') ?>">Contributor Login</a></li>
                    <li><a href="<?= site_url('upload') ?>">Submit Dataset</a></li>
                </ul>
            </section>

            <section>
                <h3 class="ft-heading">Contact</h3>
                <ul class="ft-contact-list">
                    <li>Camarines Sur Polytechnic Colleges, Nabua, Camarines Sur</li>
                    <li><a href="mailto:repository@cspc.edu.ph">repository@cspc.edu.ph</a></li>
                    <li>ASOG Technology Business Incubator</li>
                </ul>
            </section>
        </div>

        <div class="ft-bottom">
            <p>&copy; <?= date('Y') ?> ASOG TBI Dataset Repository</p>
            <p>Built for CSPC and ASOG TBI</p>
        </div>
    </div>
</footer>

<script>
    const header = document.getElementById('site-header');
    const toggle = document.querySelector('.menu-toggle');
    const syncHeader = () => header?.classList.toggle('site-header--scrolled', window.scrollY > 8);

    syncHeader();
    window.addEventListener('scroll', syncHeader, { passive: true });

    toggle?.addEventListener('click', () => {
        const isOpen = header.classList.toggle('is-menu-open');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
</script>
</body>
</html>
