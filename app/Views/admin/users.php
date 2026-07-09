<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell">
    <section class="panel">
        <div class="panel-head">
            <div>
                <p class="tag">Admin Users</p>
                <h1>User Management</h1>
            </div>
            <p class="muted">Account activation and deactivation belong to this window under MVP-FR-08.</p>
        </div>
        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($users ?? []) as $user): ?>
                        <tr>
                            <td><?= esc($user['name']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['role_name'] ?? 'Unassigned') ?></td>
                            <td><span class="status-pill"><?= esc($user['status']) ?></span></td>
                            <td><?= esc($user['last_login_at'] ?: 'Never') ?></td>
                            <td>
                                <?php if (($user['status'] ?? '') === 'active'): ?>
                                    <form method="post" action="<?= site_url('admin/users/' . $user['id'] . '/deactivate') ?>">
                                        <?= csrf_field() ?>
                                        <button class="button secondary" type="submit">Deactivate</button>
                                    </form>
                                <?php else: ?>
                                    <form method="post" action="<?= site_url('admin/users/' . $user['id'] . '/activate') ?>">
                                        <?= csrf_field() ?>
                                        <button class="button" type="submit">Activate</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</section>
<?= $this->endSection() ?>
