<?= $this->extend('layouts/portal') ?>

<?= $this->section('content') ?>
<?php
    $roleDescriptions = [
        'user' => 'Contributor access',
        'technical_reviewer' => 'File and metadata gate',
        'ethics_reviewer' => 'Ethics clearance gate',
        'repository_administrator' => 'Full governance control',
    ];
    $activeCount = count(array_filter($users, static fn (array $user): bool => ($user['status'] ?? '') === 'active'));
?>

<header class="portal-heading access-heading">
    <p class="eyebrow">Access Control</p>
    <h1>Users and roles</h1>
    <p>Manage maintainer access at directory scale while preserving the final active administrator.</p>
</header>

<section class="access-directory-shell panel">
    <div class="access-directory-toolbar">
        <div class="access-directory-metrics" aria-label="User access summary">
            <span><strong><?= esc((string) count($users)) ?></strong> accounts</span>
            <span><strong><?= esc((string) $activeCount) ?></strong> active</span>
            <span><strong><?= esc((string) count($roles)) ?></strong> roles</span>
        </div>
        <div class="access-directory-filters">
            <label class="sr-only" for="access-search">Search accounts</label>
            <input id="access-search" data-access-search placeholder="Search name, email, or role">
            <label class="sr-only" for="access-status-filter">Filter by status</label>
            <select id="access-status-filter" data-access-status-filter>
                <option value="">All statuses</option>
                <option value="active">Active only</option>
                <option value="inactive">Inactive only</option>
            </select>
            <label class="sr-only" for="access-role-filter">Filter by role</label>
            <select id="access-role-filter" data-access-role-filter>
                <option value="">All roles</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= esc($role['name'], 'attr') ?>"><?= esc(str_replace('_', ' ', (string) $role['name'])) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="access-directory-head" aria-hidden="true">
        <span>Account</span>
        <span>Status</span>
        <span>Roles</span>
        <span>Action</span>
    </div>

    <div class="access-directory-list" data-access-list>
        <?php foreach ($users as $user): ?>
            <?php
                $assignedRoles = $userRoles[(int) $user['id']] ?? [];
                $isCurrentUser = (int) $user['id'] === $currentUserId;
                $isActive = ($user['status'] ?? '') === 'active';
                $searchBlob = strtolower(trim((string) $user['name'] . ' ' . (string) $user['email'] . ' ' . implode(' ', $assignedRoles)));
            ?>
            <form
                class="user-access-directory-row"
                method="post"
                action="<?= site_url('admin/users/' . $user['id']) ?>"
                data-access-row
                data-status="<?= esc($isActive ? 'active' : 'inactive', 'attr') ?>"
                data-roles="<?= esc(implode(' ', $assignedRoles), 'attr') ?>"
                data-search="<?= esc($searchBlob, 'attr') ?>"
            >
                <?= csrf_field() ?>
                <div class="access-directory-summary">
                    <div class="access-avatar" aria-hidden="true"><?= esc(strtoupper(substr((string) $user['name'], 0, 1))) ?></div>
                    <div>
                        <div class="access-user-title">
                            <h2><?= esc($user['name']) ?></h2>
                            <?php if ($isCurrentUser): ?>
                                <span class="access-current">Current</span>
                            <?php endif; ?>
                        </div>
                        <p class="muted"><?= esc($user['email']) ?></p>
                    </div>
                </div>

                <div>
                    <span class="access-status <?= $isActive ? 'is-active' : 'is-inactive' ?>"><?= $isActive ? 'Active' : 'Inactive' ?></span>
                </div>

                <div class="access-role-preview" aria-label="Assigned roles">
                    <?php foreach ($assignedRoles as $assignedRole): ?>
                        <span><?= esc(str_replace('_', ' ', $assignedRole)) ?></span>
                    <?php endforeach; ?>
                </div>

                <details class="access-editor">
                    <summary>Edit access</summary>
                    <div class="access-editor-panel">
                        <label class="access-status-control">Account status
                            <select name="status">
                                <option value="active" <?= $isActive ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= ! $isActive ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </label>

                        <fieldset class="access-role-grid">
                            <legend>Role assignments</legend>
                            <?php foreach ($roles as $role): ?>
                                <?php $roleName = (string) $role['name']; ?>
                                <label class="access-role-option">
                                    <input type="checkbox" name="roles[]" value="<?= esc($roleName) ?>" <?= in_array($roleName, $assignedRoles, true) ? 'checked' : '' ?>>
                                    <span>
                                        <strong><?= esc(str_replace('_', ' ', $roleName)) ?></strong>
                                        <small><?= esc($roleDescriptions[$roleName] ?? 'Repository responsibility') ?></small>
                                    </span>
                                </label>
                            <?php endforeach; ?>
                        </fieldset>

                        <div class="access-card-actions">
                            <p class="muted">Changes apply immediately after saving.</p>
                            <button class="button" type="submit">Save access</button>
                        </div>
                    </div>
                </details>
            </form>
        <?php endforeach; ?>
    </div>

    <p class="muted access-empty" data-access-empty hidden>No accounts match the current filters.</p>
</section>

<script>
(() => {
    const search = document.querySelector('[data-access-search]');
    const status = document.querySelector('[data-access-status-filter]');
    const role = document.querySelector('[data-access-role-filter]');
    const rows = Array.from(document.querySelectorAll('[data-access-row]'));
    const empty = document.querySelector('[data-access-empty]');
    if (!search || !status || !role || !empty) return;

    const applyFilters = () => {
        const term = search.value.trim().toLowerCase();
        const wantedStatus = status.value;
        const wantedRole = role.value;
        let visible = 0;

        rows.forEach((row) => {
            const matchesText = term === '' || row.dataset.search.includes(term);
            const matchesStatus = wantedStatus === '' || row.dataset.status === wantedStatus;
            const matchesRole = wantedRole === '' || row.dataset.roles.split(' ').includes(wantedRole);
            const shouldShow = matchesText && matchesStatus && matchesRole;
            row.hidden = !shouldShow;
            if (shouldShow) visible++;
        });

        empty.hidden = visible > 0;
    };

    [search, status, role].forEach((control) => control.addEventListener('input', applyFilters));
})();
</script>
<?= $this->endSection() ?>
