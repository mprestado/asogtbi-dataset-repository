<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Contributor Access</p>
        <h1>Create an Account</h1>
        <p class="lead">Register to upload datasets, manage your submissions, cite records, and download Published datasets.</p>
    </div>
</section>

<section class="shell auth-shell">
    <section class="form-card auth-card">
        <div class="panel-head">
            <div>
                <p class="tag">Registration</p>
                <h2>Join the repository</h2>
            </div>
        </div>
        <form method="post" action="<?= site_url('register') ?>">
            <?= csrf_field() ?>
            <label for="name">Name</label>
            <input id="name" name="name" value="<?= old('name') ?>" placeholder="Full name">

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= old('email') ?>" placeholder="name@cspc.edu.ph">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Minimum 8 characters">

            <div class="actions">
                <button class="button" type="submit">Register</button>
            </div>
        </form>
        <p class="muted auth-link">Already registered? <a href="<?= site_url('login') ?>">Log in</a></p>
    </section>

    <aside class="panel">
        <p class="tag">User Role</p>
        <h2>What your account can do</h2>
        <ul class="stack-list">
            <?php foreach (($registerNotes ?? []) as $note): ?>
                <li><?= esc($note) ?></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</section>
<?= $this->endSection() ?>
