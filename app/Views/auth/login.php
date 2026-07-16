<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $flashValidation = session()->getFlashdata('validation');
    $errors = is_array($validation ?? null) ? $validation : (is_array($flashValidation) ? $flashValidation : []);
?>

<section class="auth-stage auth-stage--login">
    <a class="auth-back-link" href="<?= site_url('datasets') ?>">
        <span class="material-symbols-rounded" aria-hidden="true">arrow_back</span>
        Browse as guest
    </a>

    <div class="auth-island auth-island--workspace">
        <aside class="auth-intro-panel">
            <div class="auth-heading">
                <h1>Sign in to your workspace</h1>
                <p>Access dataset uploads, reviewer queues, citations, and protected dataset tools through your account.</p>
            </div>

            <div class="auth-policy-copy">
                <p class="eyebrow">Student Access Only</p>
                <p>This repository requires a <strong>my.cspc.edu.ph</strong> student account. Don&apos;t have one? <a href="<?= site_url('register') ?>">Register here.</a></p>
            </div>

            <div class="auth-brand-row" aria-label="Repository partners">
                <img src="<?= base_url('assets/img/brand/asogtbi-logo.webp') ?>" alt="DOST Bicol ASOG Technology Business Incubator">
                <img src="<?= base_url('assets/img/brand/ccs-logo.png') ?>" alt="College of Computer Studies">
            </div>
        </aside>

        <section class="auth-panel" aria-labelledby="login-heading">
            <h2 class="sr-only" id="login-heading">SIGN IN</h2>

            <form class="auth-form" method="post" action="<?= site_url('login') ?>" novalidate>
                <?= csrf_field() ?>

                <div class="auth-field">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?= old('email') ?>"
                        autocomplete="email"
                        inputmode="email"
                        placeholder="name@my.cspc.edu.ph"
                        aria-describedby="email-help <?= isset($errors['email']) ? 'email-error' : '' ?>"
                        <?= isset($errors['email']) ? 'aria-invalid="true"' : '' ?>
                    >
                    <p class="field-help" id="email-help">Use the repository account assigned to your contributor or maintainer role.</p>
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
                    <p class="field-help" id="password-help">Passwords are case-sensitive.</p>
                    <?php if (isset($errors['password'])): ?><p class="field-error" id="password-error"><?= esc($errors['password']) ?></p><?php endif; ?>
                </div>

                <button class="button auth-submit" type="submit">SIGN IN</button>
            </form>

            <div class="auth-divider"><span>or</span></div>

            <button class="auth-google-button" type="button" disabled aria-disabled="true">
                <span class="auth-google-mark" aria-hidden="true">G</span>
                CONTINUE WITH CSPC GOOGLE ACCOUNT
            </button>

            <div class="auth-footnotes">
                <p><a href="<?= site_url('forgot-password') ?>">Forgot password?</a></p>
            </div>

            <details class="auth-demo-note">
                <summary>Local demo accounts</summary>
                <p>For development walkthroughs after migrations and `MvpSeeder`; not part of the production sign-in experience.</p>
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
