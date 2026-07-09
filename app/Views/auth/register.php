<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <h1>Register</h1>
        <p class="muted">The MVP allows registration or administrator-created accounts. This form is ready for the first path while role assignment and activation stay visible to admins.</p>
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
                <a class="button secondary" href="<?= site_url('login') ?>">Back to login</a>
            </div>
        </form>
    </section>

    <aside class="panel">
        <p class="tag">Required Fields</p>
        <h2>MVP registration inputs</h2>
        <ul class="stack-list">
            <?php foreach (($requiredFields ?? []) as $field): ?>
                <li><?= esc($field) ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Implementation notes</h3>
        <ul class="stack-list">
            <?php foreach (($registerNotes ?? []) as $note): ?>
                <li><?= esc($note) ?></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</section>
<?= $this->endSection() ?>
