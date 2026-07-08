<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Login</h1>
    <p class="muted">Skeleton page for MVP-FR-01 and MVP-FR-02.</p>
    <form method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" autocomplete="email">

        <label for="password">Password</label>
        <input id="password" type="password" name="password" autocomplete="current-password">

        <div class="actions">
            <button class="button" type="submit">Log In</button>
            <a href="<?= site_url('register') ?>">Create account</a>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
