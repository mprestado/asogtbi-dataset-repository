<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $flashValidation = session()->getFlashdata('validation');
    $errors = is_array($validation ?? null) ? $validation : (is_array($flashValidation) ? $flashValidation : []);
    $roleLabels = [
        'user' => 'Contributor',
        'ethics_reviewer' => 'Ethics Reviewer',
        'technical_reviewer' => 'Technical Reviewer',
        'repository_administrator' => 'Repository Administrator',
    ];
?>

<section class="hero-panel profile-hero">
    <div class="shell">
        <p class="eyebrow">Account Settings</p>
        <h1>Profile and sign-in details</h1>
        <p class="lead">Review your repository identity, update basic account details, and change your password when needed.</p>
    </div>
</section>

<section class="shell content-section profile-settings-shell">
    <aside class="panel profile-summary-card">
        <div class="profile-avatar" aria-hidden="true"><?= esc(strtoupper(substr((string) ($user['name'] ?? 'U'), 0, 1))) ?></div>
        <div>
            <p class="tag">Signed in as</p>
            <h2><?= esc($user['name'] ?? 'Repository user') ?></h2>
            <p class="muted"><?= esc($user['email'] ?? '') ?></p>
        </div>

        <dl class="profile-meta-list">
            <div>
                <dt>Status</dt>
                <dd><span class="status-chip status-<?= esc((string) ($user['status'] ?? 'inactive')) ?>"><?= esc(ucfirst((string) ($user['status'] ?? 'inactive'))) ?></span></dd>
            </div>
            <div>
                <dt>Roles</dt>
                <dd class="profile-role-list">
                    <?php foreach ($roles as $role): ?>
                        <span><?= esc($roleLabels[$role] ?? ucwords(str_replace('_', ' ', $role))) ?></span>
                    <?php endforeach; ?>
                </dd>
            </div>
            <div>
                <dt>Last login</dt>
                <dd><?= ! empty($user['last_login_at']) ? esc(date('M j, Y g:i A', strtotime((string) $user['last_login_at']))) : 'Not recorded' ?></dd>
            </div>
            <div>
                <dt>Account created</dt>
                <dd><?= ! empty($user['created_at']) ? esc(date('M j, Y', strtotime((string) $user['created_at']))) : 'Not recorded' ?></dd>
            </div>
        </dl>
    </aside>

    <section class="form-card profile-settings-card">
        <div class="panel-head">
            <div>
                <p class="tag">Editable Details</p>
                <h2>Update your profile</h2>
            </div>
        </div>

        <form class="profile-settings-form" method="post" action="<?= site_url('account/settings') ?>" novalidate>
            <?= csrf_field() ?>

            <label for="name">Full name</label>
            <input
                id="name"
                name="name"
                value="<?= old('name', (string) ($user['name'] ?? '')) ?>"
                autocomplete="name"
                class="<?= isset($errors['name']) ? 'field-error__input' : '' ?>"
                aria-describedby="name-help <?= isset($errors['name']) ? 'name-error' : '' ?>"
                <?= isset($errors['name']) ? 'aria-invalid="true"' : '' ?>
            >
            <p class="field-help" id="name-help">This name appears on your submissions, reviews, and account menus.</p>
            <?php if (isset($errors['name'])): ?><p class="field-error" id="name-error"><?= esc($errors['name']) ?></p><?php endif; ?>

            <label for="email">Email address</label>
            <input
                id="email"
                type="email"
                name="email"
                value="<?= old('email', (string) ($user['email'] ?? '')) ?>"
                autocomplete="email"
                inputmode="email"
                class="<?= isset($errors['email']) ? 'field-error__input' : '' ?>"
                aria-describedby="email-help <?= isset($errors['email']) ? 'email-error' : '' ?>"
                <?= isset($errors['email']) ? 'aria-invalid="true"' : '' ?>
            >
            <p class="field-help" id="email-help">Use an address you can access. Registration remains school-domain gated for new self-service accounts.</p>
            <?php if (isset($errors['email'])): ?><p class="field-error" id="email-error"><?= esc($errors['email']) ?></p><?php endif; ?>

            <div class="profile-password-panel">
                <p class="tag">Password</p>
                <p class="muted">Leave these fields blank to keep your current password.</p>

                <label for="current_password">Current password</label>
                <input
                    id="current_password"
                    type="password"
                    name="current_password"
                    autocomplete="current-password"
                    class="<?= isset($errors['current_password']) ? 'field-error__input' : '' ?>"
                    aria-describedby="<?= isset($errors['current_password']) ? 'current-password-error' : '' ?>"
                    <?= isset($errors['current_password']) ? 'aria-invalid="true"' : '' ?>
                >
                <?php if (isset($errors['current_password'])): ?><p class="field-error" id="current-password-error"><?= esc($errors['current_password']) ?></p><?php endif; ?>

                <label for="new_password">New password</label>
                <input
                    id="new_password"
                    type="password"
                    name="new_password"
                    autocomplete="new-password"
                    class="<?= isset($errors['new_password']) ? 'field-error__input' : '' ?>"
                    aria-describedby="new-password-help <?= isset($errors['new_password']) ? 'new-password-error' : '' ?>"
                    <?= isset($errors['new_password']) ? 'aria-invalid="true"' : '' ?>
                >
                <p class="field-help" id="new-password-help">Use at least 8 characters.</p>
                <?php if (isset($errors['new_password'])): ?><p class="field-error" id="new-password-error"><?= esc($errors['new_password']) ?></p><?php endif; ?>

                <label for="new_password_confirm">Confirm new password</label>
                <input
                    id="new_password_confirm"
                    type="password"
                    name="new_password_confirm"
                    autocomplete="new-password"
                    class="<?= isset($errors['new_password_confirm']) ? 'field-error__input' : '' ?>"
                    aria-describedby="<?= isset($errors['new_password_confirm']) ? 'new-password-confirm-error' : '' ?>"
                    <?= isset($errors['new_password_confirm']) ? 'aria-invalid="true"' : '' ?>
                >
                <?php if (isset($errors['new_password_confirm'])): ?><p class="field-error" id="new-password-confirm-error"><?= esc($errors['new_password_confirm']) ?></p><?php endif; ?>
            </div>

            <div class="profile-settings-actions">
                <a class="button secondary" href="<?= site_url('dashboard') ?>">Cancel</a>
                <button class="button" type="submit">Save settings</button>
            </div>
        </form>
    </section>
</section>
<?= $this->endSection() ?>
