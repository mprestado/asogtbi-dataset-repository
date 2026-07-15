<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'ASOG TBI Dataset Repository') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800;900&family=DM+Serif+Display&family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..24,400,0,0&display=swap" rel="stylesheet">
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
                <a href="<?= site_url('upload') ?>">Upload</a>
            <?php endif; ?>
        </nav>

        <div class="nav-actions">
            <?php if ($isAuthenticated): ?>
                <details class="account-menu">
                    <summary class="account-trigger" aria-label="Open account menu">
                        <span class="material-symbols-rounded" aria-hidden="true">account_circle</span>
                    </summary>
                    <div class="account-popover">
                        <p class="account-name"><?= esc((string) session()->get('user_name')) ?></p>
                        <a href="<?= site_url('dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">database</span> My datasets</a>
                        <?php if (in_array('ethics_reviewer', $roles, true) || in_array('technical_reviewer', $roles, true) || in_array('repository_administrator', $roles, true)): ?>
                            <a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Portal records</a>
                        <?php endif; ?>
                        <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
                        <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
                        <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin dashboard</a><?php endif; ?>
                        <form class="nav-form" method="post" action="<?= site_url('logout') ?>">
                            <?= csrf_field() ?>
                            <button type="submit"><span class="material-symbols-rounded" aria-hidden="true">logout</span> Logout</button>
                        </form>
                    </div>
                </details>
            <?php else: ?>
                <a class="nav-cta" href="<?= site_url('login') ?>"><span class="material-symbols-rounded" aria-hidden="true">login</span> Login</a>
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
            <a href="<?= site_url('upload') ?>">Upload</a>
            <div class="mobile-account-panel">
                <p><?= esc((string) session()->get('user_name')) ?></p>
                <a href="<?= site_url('dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">database</span> My datasets</a>
                <?php if (in_array('ethics_reviewer', $roles, true) || in_array('technical_reviewer', $roles, true) || in_array('repository_administrator', $roles, true)): ?>
                    <a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Portal records</a>
                <?php endif; ?>
                <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
                <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
                <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin dashboard</a><?php endif; ?>
            </div>
            <form class="nav-form" method="post" action="<?= site_url('logout') ?>">
                <?= csrf_field() ?>
                <button class="nav-cta" type="submit"><span class="material-symbols-rounded" aria-hidden="true">logout</span> Logout</button>
            </form>
        <?php else: ?>
            <a href="<?= site_url('login') ?>"><span class="material-symbols-rounded" aria-hidden="true">login</span> Login</a>
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
