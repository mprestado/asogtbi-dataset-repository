<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <h1>Login</h1>
        <p class="muted">This window covers MVP-FR-01 and MVP-FR-02. The form is in place for email-and-password login, while the actual authentication guard logic still needs to be completed.</p>
        <form method="post" action="<?= site_url('login') ?>">
            <?= csrf_field() ?>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" autocomplete="email">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" autocomplete="current-password">

            <div class="actions">
                <button class="button" type="submit">Log In</button>
                <a class="button secondary" href="<?= site_url('register') ?>">Create account</a>
            </div>
        </form>
    </section>

    <aside class="panel">
        <p class="tag">Demo Access</p>
        <h2>Seed-backed local accounts</h2>
        <ul class="record-list">
            <?php foreach (($demoAccounts ?? []) as $account): ?>
                <li>
                    <strong><?= esc($account['role']) ?></strong>
                    <span class="muted"><?= esc($account['email']) ?> / <?= esc($account['password']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3>What this screen should enforce</h3>
        <ul class="stack-list">
            <?php foreach (($loginChecks ?? []) as $check): ?>
                <li><?= esc($check) ?></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</section>
<?= $this->endSection() ?>
