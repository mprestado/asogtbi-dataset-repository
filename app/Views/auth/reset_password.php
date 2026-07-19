<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Account Recovery</p>
        <h1>Reset Password</h1>
        <p class="lead">Choose a new password for your repository password account.</p>
    </div>
</section>

<section class="shell auth-shell">
    <section class="form-card auth-card">
        <div class="panel-head">
            <div>
                <p class="tag">New Password</p>
                <h2><?= ! empty($isValidToken) ? 'Create a new password' : 'Invalid reset link' ?></h2>
            </div>
        </div>

        <?php if (empty($isValidToken)): ?>
            <p class="muted">This password reset link is invalid, already used, or expired. Request a new link to continue.</p>
            <div class="actions">
                <a class="button" href="<?= site_url('forgot-password') ?>">Request New Link</a>
            </div>
        <?php else: ?>
            <form method="post" action="<?= site_url('reset-password') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="email" value="<?= esc($email ?? '') ?>">
                <input type="hidden" name="token" value="<?= esc($token ?? '') ?>">

                <label for="password">New Password</label>
                <input id="password" type="password" name="password" autocomplete="new-password" placeholder="At least 8 characters">

                <label for="password_confirm">Confirm New Password</label>
                <input id="password_confirm" type="password" name="password_confirm" autocomplete="new-password" placeholder="Repeat your password">

                <div class="actions">
                    <button class="button" type="submit">Update Password</button>
                </div>
            </form>
        <?php endif; ?>
    </section>

    <aside class="panel">
        <p class="tag">Security</p>
        <h2>Reset limits</h2>
        <p class="muted">Reset links expire after 30 minutes and can only be used once. Passwords are stored as hashes, never as plain text.</p>
    </aside>
</section>
<?= $this->endSection() ?>
