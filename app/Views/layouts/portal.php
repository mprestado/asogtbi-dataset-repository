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
    $flashInfo = session()->getFlashdata('info');
    $flashError = session()->getFlashdata('error');
    $isMaintainer = array_intersect($roles, ['repository_administrator', 'technical_reviewer', 'ethics_reviewer']) !== [];
    $portalHome = in_array('repository_administrator', $roles, true)
        ? site_url('admin')
        : (in_array('technical_reviewer', $roles, true) ? site_url('review/technical') : (in_array('ethics_reviewer', $roles, true) ? site_url('review/ethics') : site_url('portal/dashboard')));
    $portalUserId = (int) session()->get('user_id');
    $portalNotifications = $portalUserId > 0
        ? model(\App\Models\NotificationModel::class)->where('user_id', $portalUserId)->orderBy('created_at', 'DESC')->findAll(5)
        : [];
    $portalUnreadCount = $portalUserId > 0
        ? model(\App\Models\NotificationModel::class)->where('user_id', $portalUserId)->where('read_at', null)->countAllResults()
        : 0;
    $latestUnread = $portalUserId > 0
        ? model(\App\Models\NotificationModel::class)->where('user_id', $portalUserId)->where('read_at', null)->orderBy('id', 'DESC')->first()
        : null;
    $latestUnreadId = is_array($latestUnread) ? (int) $latestUnread['id'] : 0;
?>
<div class="portal-frame">
    <aside class="portal-sidebar">
        <a class="portal-brand" href="<?= $portalHome ?>">
            <img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI">
            <span>Repository Governance</span>
        </a>
        <nav class="portal-nav" aria-label="Portal navigation">
            <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
            <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
            <?php if (in_array('repository_administrator', $roles, true)): ?>
                <a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin overview</a>
                <a href="<?= site_url('admin/datasets') ?>"><span class="material-symbols-rounded" aria-hidden="true">rule_settings</span> Dataset moderation</a>
                <a href="<?= site_url('admin/users') ?>"><span class="material-symbols-rounded" aria-hidden="true">group</span> Users and roles</a>
                <a href="<?= site_url('admin/audit-logs') ?>"><span class="material-symbols-rounded" aria-hidden="true">manage_search</span> Audit logs</a>
            <?php endif; ?>
            <details class="portal-activity-menu" data-activity-menu data-latest-id="<?= esc((string) $latestUnreadId, 'attr') ?>">
                <summary>
                    <span><span class="material-symbols-rounded" aria-hidden="true">notifications_active</span> New activities</span>
                    <span class="portal-activity-badge" data-activity-count <?= $portalUnreadCount < 1 ? 'hidden' : '' ?>><?= esc((string) $portalUnreadCount) ?></span>
                </summary>
                <div class="portal-activity-list" data-activity-list>
                    <?php if ($portalNotifications === []): ?>
                        <p class="muted">No recent activities.</p>
                    <?php else: ?>
                        <?php foreach ($portalNotifications as $notification): ?>
                            <a class="<?= empty($notification['read_at']) ? 'is-unread' : '' ?>" href="<?= ! empty($notification['link']) ? site_url(ltrim((string) $notification['link'], '/')) : '#' ?>">
                                <strong><?= esc($notification['title']) ?></strong>
                                <small><?= esc($notification['message']) ?></small>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <form method="post" action="<?= site_url('portal/notifications/read') ?>"><?= csrf_field() ?><button class="text-button" type="submit">Mark activities read</button></form>
                </div>
            </details>
            <?php if (! $isMaintainer): ?><a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Contributor records</a><?php endif; ?>
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
                    <a href="<?= site_url('account/settings') ?>"><span class="material-symbols-rounded" aria-hidden="true">manage_accounts</span> Profile settings</a>
                    <a href="<?= site_url('portal/dashboard') ?>"><span class="material-symbols-rounded" aria-hidden="true">folder_managed</span> Contributor records</a>
                    <?php if (in_array('technical_reviewer', $roles, true)): ?><a href="<?= site_url('review/technical') ?>"><span class="material-symbols-rounded" aria-hidden="true">sdk</span> Technical reviews</a><?php endif; ?>
                    <?php if (in_array('ethics_reviewer', $roles, true)): ?><a href="<?= site_url('review/ethics') ?>"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span> Ethics reviews</a><?php endif; ?>
                    <?php if (in_array('repository_administrator', $roles, true)): ?><a href="<?= site_url('admin') ?>"><span class="material-symbols-rounded" aria-hidden="true">dashboard</span> Admin dashboard</a><?php endif; ?>
                    <form method="post" action="<?= site_url('logout') ?>"><?= csrf_field() ?><button class="button secondary" type="submit"><span class="material-symbols-rounded" aria-hidden="true">logout</span> Logout</button></form>
                </div>
            </details>
            <a class="button portal-return" href="<?= site_url('/') ?>"><span class="material-symbols-rounded" aria-hidden="true">open_in_new</span> Return to website</a>
        </div>
    </aside>
    <main class="portal-main">
        <div class="portal-live-toast" data-live-toast hidden>
            <strong data-live-toast-title>New activity</strong>
            <span data-live-toast-message>Open New activities for details.</span>
        </div>
        <div class="flash-stack flash-stack--portal" aria-live="polite" aria-atomic="true">
            <?php if ($flashInfo): ?>
                <div class="flash-toast flash-toast--success" role="status" data-flash-toast>
                    <span class="material-symbols-rounded" aria-hidden="true">check_circle</span>
                    <div>
                        <strong>Changes saved</strong>
                        <p><?= esc($flashInfo) ?></p>
                    </div>
                    <button type="button" data-flash-dismiss aria-label="Dismiss notification"><span class="material-symbols-rounded" aria-hidden="true">close</span></button>
                </div>
            <?php endif; ?>
            <?php if ($flashError): ?>
                <div class="flash-toast flash-toast--error" role="alert" data-flash-toast>
                    <span class="material-symbols-rounded" aria-hidden="true">error</span>
                    <div>
                        <strong>Needs attention</strong>
                        <p><?= esc($flashError) ?></p>
                    </div>
                    <button type="button" data-flash-dismiss aria-label="Dismiss notification"><span class="material-symbols-rounded" aria-hidden="true">close</span></button>
                </div>
            <?php endif; ?>
        </div>
        <?= $this->renderSection('content') ?>
    </main>
</div>
<script>
(() => {
    document.querySelectorAll('[data-flash-toast]').forEach((toast) => {
        const close = () => {
            toast.classList.add('is-leaving');
            window.setTimeout(() => toast.remove(), 220);
        };
        toast.querySelector('[data-flash-dismiss]')?.addEventListener('click', close);
        window.setTimeout(close, toast.classList.contains('flash-toast--error') ? 9000 : 5600);
    });

    const menu = document.querySelector('[data-activity-menu]');
    const badge = document.querySelector('[data-activity-count]');
    const toast = document.querySelector('[data-live-toast]');
    if (!menu || !badge || !toast) return;

    let latestId = Number(menu.dataset.latestId || 0);
    let audioContext = null;
    let audioReady = false;

    const unlockAudio = () => {
        audioReady = true;
        audioContext ??= new (window.AudioContext || window.webkitAudioContext)();
    };
    window.addEventListener('pointerdown', unlockAudio, { once: true });
    window.addEventListener('keydown', unlockAudio, { once: true });

    const beep = () => {
        if (!audioReady || !audioContext) return;
        const oscillator = audioContext.createOscillator();
        const gain = audioContext.createGain();
        oscillator.type = 'sine';
        oscillator.frequency.value = 880;
        gain.gain.setValueAtTime(0.0001, audioContext.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.08, audioContext.currentTime + 0.02);
        gain.gain.exponentialRampToValueAtTime(0.0001, audioContext.currentTime + 0.24);
        oscillator.connect(gain).connect(audioContext.destination);
        oscillator.start();
        oscillator.stop(audioContext.currentTime + 0.25);
    };

    const showToast = (latest) => {
        toast.querySelector('[data-live-toast-title]').textContent = latest?.title || 'New activity';
        toast.querySelector('[data-live-toast-message]').textContent = latest?.message || 'Open New activities for details.';
        toast.hidden = false;
        window.setTimeout(() => { toast.hidden = true; }, 7000);
    };

    const updateBadge = (count) => {
        badge.textContent = String(count);
        badge.hidden = count < 1;
    };

    const poll = async () => {
        try {
            const response = await fetch('<?= site_url('portal/notifications/poll') ?>', { headers: { 'Accept': 'application/json' } });
            if (!response.ok) return;
            const data = await response.json();
            updateBadge(Number(data.unreadCount || 0));
            const incomingId = Number(data.latest?.id || 0);
            if (incomingId > latestId) {
                if (latestId > 0) {
                    showToast(data.latest);
                    beep();
                }
                latestId = incomingId;
                menu.dataset.latestId = String(incomingId);
            }
        } catch (error) {
            // Keep polling quiet; visual badge refresh resumes when the next request succeeds.
        }
    };

    window.setInterval(poll, 25000);
})();
</script>
</body>
</html>
