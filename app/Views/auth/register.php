<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $flashValidation = session()->getFlashdata('validation');
    $errors = is_array($validation ?? null) ? $validation : (is_array($flashValidation) ? $flashValidation : []);
?>

<section class="auth-stage">
    <div class="auth-island">
        <section class="auth-panel">
            <a class="auth-back-link" href="<?= site_url('/') ?>">
                <span class="material-symbols-rounded" aria-hidden="true">arrow_back</span>
                Back to repository
            </a>

            <div class="auth-heading">
                <p class="eyebrow">Contributor Enrollment</p>
                <h1>Sign up for repository access</h1>
                <p>Create a contributor account for dataset uploads, citation tools, revision loops, and authenticated catalog access.</p>
            </div>

            <button class="auth-google-button" type="button" disabled aria-disabled="true">
                <span class="auth-google-mark" aria-hidden="true">G</span>
                Continue with Google
                <small>Coming soon</small>
            </button>

            <div class="auth-divider"><span>or create an account</span></div>

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
                    <label for="email">CSPC email address</label>
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
                    <p class="field-help" id="email-help">For this release, self-registration is limited to official `@cspc.edu.ph` addresses.</p>
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
                    <p class="field-help" id="password-help">Use at least 8 characters. Avoid passwords reused from school or personal accounts.</p>
                    <?php if (isset($errors['password'])): ?><p class="field-error" id="password-error"><?= esc($errors['password']) ?></p><?php endif; ?>
                </div>

                <button class="button auth-submit" type="submit">Sign up</button>
            </form>

            <p class="auth-footnotes">Already have access? <a href="<?= site_url('login') ?>">Sign in</a></p>
        </section>

        <aside class="auth-policy-card">
            <p class="tag">Access Policy</p>
            <h2>What this account can do</h2>
            <ul class="auth-policy-list">
                <?php foreach (($registerNotes ?? []) as $note): ?>
                    <li><?= esc($note) ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="auth-domain-note">
                <span class="material-symbols-rounded" aria-hidden="true">policy</span>
                <p>Reviewer and administrator privileges are assigned separately by repository administrators after account creation.</p>
            </div>
        </aside>
    </div>
</section>
<?= $this->endSection() ?>
