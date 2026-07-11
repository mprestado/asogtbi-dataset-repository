<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Account Access</p>
        <h1>Log In</h1>
        <p class="lead">Access your ASOG TBI dataset submissions, downloads, citations, and upload tools.</p>
    </div>
</section>

<section class="shell auth-shell">
    <section class="form-card auth-card">
        <div class="panel-head">
            <div>
                <p class="tag">Contributor Login</p>
                <h2>Welcome back</h2>
            </div>
        </div>
        <form method="post" action="<?= site_url('login') ?>">
            <?= csrf_field() ?>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= old('email') ?>" autocomplete="email" placeholder="user@example.test">

            <label for="password">Password</label>
            <input id="password" type="password" name="password" autocomplete="current-password" placeholder="Enter your password">

            <div class="actions">
                <button class="button" type="submit">Log In</button>
            </div>
        </form>
        <p class="muted auth-link">No account yet? <a href="<?= site_url('register') ?>">Register</a></p>
        <p class="muted auth-link">Forgot your password? <a href="<?= site_url('forgot-password') ?>">Reset it</a></p>
    </section>

    <aside class="panel">
        <p class="tag">Local Demo</p>
        <h2>Seed-backed account</h2>
        <p class="muted">Use this account after running migrations and `MvpSeeder` locally.</p>
        <ul class="record-list">
            <?php foreach (($demoAccounts ?? []) as $account): ?>
                <li>
                    <strong><?= esc($account['role']) ?></strong>
                    <span class="muted"><?= esc($account['email']) ?> / <?= esc($account['password']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>
</section>
<?= $this->endSection() ?>
