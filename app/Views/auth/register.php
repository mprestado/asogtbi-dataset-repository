<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Register</h1>
    <p class="muted">Skeleton page for account creation or later admin-created accounts.</p>
    <form method="post" action="<?= site_url('register') ?>">
        <?= csrf_field() ?>
        <label for="name">Name</label>
        <input id="name" name="name">

        <label for="email">Email</label>
        <input id="email" type="email" name="email">

        <label for="password">Password</label>
        <input id="password" type="password" name="password">

        <div class="actions">
            <button class="button" type="submit">Register</button>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
