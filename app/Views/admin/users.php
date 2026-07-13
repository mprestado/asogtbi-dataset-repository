<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>
<header class="portal-heading"><p class="eyebrow">Access Control</p><h1>Users and roles</h1><p>Assign multiple responsibilities while preserving an active repository administrator.</p></header>
<div class="portal-stack">
<?php foreach ($users as $user): ?>
<form class="panel user-access-row" method="post" action="<?= site_url('admin/users/' . $user['id']) ?>"><?= csrf_field() ?><div><h2><?= esc($user['name']) ?></h2><p class="muted"><?= esc($user['email']) ?><?= (int) $user['id'] === $currentUserId ? ' · Current account' : '' ?></p></div><label>Status<select name="status"><option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= $user['status'] !== 'active' ? 'selected' : '' ?>>Inactive</option></select></label><fieldset><legend>Roles</legend><?php foreach ($roles as $role): ?><label class="compact-check"><input type="checkbox" name="roles[]" value="<?= esc($role['name']) ?>" <?= in_array($role['name'], $userRoles[(int) $user['id']] ?? [], true) ? 'checked' : '' ?>> <?= esc(str_replace('_', ' ', $role['name'])) ?></label><?php endforeach; ?></fieldset><button class="button" type="submit">Save access</button></form>
<?php endforeach; ?>
</div>
<?= $this->endSection() ?>
