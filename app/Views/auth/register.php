<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $flashValidation = session()->getFlashdata('validation');
    $errors = is_array($validation ?? null) ? $validation : (is_array($flashValidation) ? $flashValidation : []);
?>

<section class="auth-stage auth-stage--register">
    <a class="auth-back-link" href="<?= site_url('datasets') ?>">
        <span class="material-symbols-rounded" aria-hidden="true">arrow_back</span>
        Browse as guest
    </a>

    <div class="auth-island auth-island--workspace">
        <aside class="auth-intro-panel">
            <div class="auth-heading">
                <h1>Register your workspace</h1>
                <p>Create contributor access for dataset uploads, citation tools, revision loops, and authenticated catalog features.</p>
            </div>

            <div class="auth-policy-copy">
                <p class="eyebrow">CSPC Account Required</p>
                <p>Self-registration is limited to official <strong>@cspc.edu.ph</strong> accounts. Already have access? <a href="<?= site_url('login') ?>">Sign in here.</a></p>
            </div>

            <ul class="auth-policy-list">
                <?php foreach (($registerNotes ?? []) as $note): ?>
                    <li><?= esc($note) ?></li>
                <?php endforeach; ?>
            </ul>

            <div class="auth-brand-row" aria-label="Repository partners">
                <img src="<?= base_url('assets/img/brand/asogtbi-logo.webp') ?>" alt="DOST Bicol ASOG Technology Business Incubator">
                <img src="<?= base_url('assets/img/brand/ccs-logo.png') ?>" alt="College of Computer Studies">
            </div>
        </aside>

        <section class="auth-panel" aria-labelledby="register-heading">
            <h2 class="sr-only" id="register-heading">Register</h2>

            <form class="auth-form" method="post" action="<?= site_url('register') ?>" novalidate>
                <?= csrf_field() ?>

                <div class="auth-field">
                    <label for="name">Full name</label>
                    <input
                        id="name"
                        name="name"
                        value="<?= old('name') ?>"
                        autocomplete="name"
                        placeholder="Juan Dela Cruz"
                        aria-describedby="name-help <?= isset($errors['name']) ? 'name-error' : '' ?>"
                        <?= isset($errors['name']) ? 'aria-invalid="true"' : '' ?>
                    >
                    <p class="field-help" id="name-help">Use the name reviewers and administrators should see on submissions.</p>
                    <?php if (isset($errors['name'])): ?><p class="field-error" id="name-error"><?= esc($errors['name']) ?></p><?php endif; ?>
                </div>

                <div class="auth-field">
                    <label for="email">CSPC email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?= old('email') ?>"
                        autocomplete="email"
                        inputmode="email"
                        placeholder="name@cspc.edu.ph"
                        aria-describedby="email-help <?= isset($errors['email']) ? 'email-error' : '' ?>"
                        <?= isset($errors['email']) ? 'aria-invalid="true"' : '' ?>
                    >
                    <p class="field-help" id="email-help">Use your official school email. Maintainer roles are assigned later by an administrator.</p>
                    <?php if (isset($errors['email'])): ?><p class="field-error" id="email-error"><?= esc($errors['email']) ?></p><?php endif; ?>
                </div>

                <div class="auth-field">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        placeholder="Minimum 8 characters"
                        aria-describedby="password-help <?= isset($errors['password']) ? 'password-error' : '' ?>"
                        <?= isset($errors['password']) ? 'aria-invalid="true"' : '' ?>
                    >
                    <p class="field-help" id="password-help">Use at least 8 characters and avoid reused passwords.</p>
                    <?php if (isset($errors['password'])): ?><p class="field-error" id="password-error"><?= esc($errors['password']) ?></p><?php endif; ?>
                </div>

                <button class="button auth-submit" type="submit">REGISTER</button>
            </form>

            <div class="auth-divider"><span>or</span></div>

            <button class="auth-google-button" type="button" disabled aria-disabled="true">
                <span class="auth-google-mark" aria-hidden="true">G</span>
                CONTINUE WITH CSPC GOOGLE ACCOUNT
            </button>

            <p class="auth-footnotes">Already have access? <a href="<?= site_url('login') ?>">Sign in</a></p>
        </section>
    </div>
</section>
<?= $this->endSection() ?>
