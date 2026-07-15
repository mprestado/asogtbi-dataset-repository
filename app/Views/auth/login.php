<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $flashValidation = session()->getFlashdata('validation');
    $errors = is_array($validation ?? null) ? $validation : (is_array($flashValidation) ? $flashValidation : []);
?>

<section class="auth-stage">
    <div class="auth-island auth-island--single">
        <section class="auth-panel">
            <a class="auth-back-link" href="<?= site_url('/') ?>">
                <span class="material-symbols-rounded" aria-hidden="true">arrow_back</span>
                Back to repository
            </a>

            <div class="auth-heading">
                <p class="eyebrow">Secure Repository Access</p>
                <h1>Sign in to your workspace</h1>
                <p>Access uploads, reviewer queues, citations, and protected dataset tools through your repository account.</p>
            </div>

            <button class="auth-google-button" type="button" disabled aria-disabled="true">
                <span class="auth-google-mark" aria-hidden="true">G</span>
                Continue with Google
                <small>Coming soon</small>
            </button>

            <div class="auth-divider"><span>or use email</span></div>

            <form class="auth-form" method="post" action="<?= site_url('login') ?>" novalidate>
                <?= csrf_field() ?>

                <div class="auth-field">
                    <label for="email">Email address</label>
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
                    <p class="field-help" id="email-help">Use the account assigned to your contributor or maintainer role.</p>
                    <?php if (isset($errors['email'])): ?><p class="field-error" id="email-error"><?= esc($errors['email']) ?></p><?php endif; ?>
                </div>

                <div class="auth-field">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        aria-describedby="password-help <?= isset($errors['password']) ? 'password-error' : '' ?>"
                        <?= isset($errors['password']) ? 'aria-invalid="true"' : '' ?>
                    >
                    <p class="field-help" id="password-help">Passwords are case-sensitive. Keep shared demo credentials out of production.</p>
                    <?php if (isset($errors['password'])): ?><p class="field-error" id="password-error"><?= esc($errors['password']) ?></p><?php endif; ?>
                </div>

                <button class="button auth-submit" type="submit">Sign in</button>
            </form>

            <div class="auth-footnotes">
                <p>New contributor? <a href="<?= site_url('register') ?>">Sign up</a></p>
                <p><a href="<?= site_url('forgot-password') ?>">Forgot password?</a></p>
            </div>

            <details class="auth-demo-note">
                <summary>Development demo accounts</summary>
                <p>For local walkthroughs only after migrations and `MvpSeeder`. This helper will be removed before production use.</p>
                <ul class="auth-demo-list">
                    <?php foreach (($demoAccounts ?? []) as $account): ?>
                        <li>
                            <strong><?= esc($account['role']) ?></strong>
                            <span><?= esc($account['email']) ?></span>
                            <code><?= esc($account['password']) ?></code>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </details>
        </section>
    </div>
</section>
<?= $this->endSection() ?>
