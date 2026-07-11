<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $resetLink = session()->getFlashdata('reset_link'); ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Account Recovery</p>
        <h1>Forgot Password</h1>
        <p class="lead">Request a short-lived reset link for an active ASOG TBI Dataset Repository account.</p>
    </div>
</section>

<section class="shell auth-shell">
    <section class="form-card auth-card">
        <div class="panel-head">
            <div>
                <p class="tag">Password Reset</p>
                <h2>Find your account</h2>
            </div>
        </div>
        <form method="post" action="<?= site_url('forgot-password') ?>">
            <?= csrf_field() ?>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= old('email') ?>" autocomplete="email" placeholder="name@cspc.edu.ph">

            <div class="actions">
                <button class="button" type="submit">Prepare Reset Link</button>
            </div>
        </form>
        <p class="muted auth-link">Remembered it? <a href="<?= site_url('login') ?>">Log in</a></p>
    </section>

    <aside class="panel">
        <p class="tag">Rapid MVP Note</p>
        <h2>Local reset behavior</h2>
        <p class="muted">This branch stores a secure, expiring reset token. Email delivery is not configured yet, so development mode displays the prepared link after a successful request.</p>
        <?php if ($resetLink): ?>
            <div class="notice">
                <strong>Development reset link</strong>
                <a href="<?= esc($resetLink) ?>"><?= esc($resetLink) ?></a>
            </div>
        <?php endif; ?>
    </aside>
</section>
<?= $this->endSection() ?>
