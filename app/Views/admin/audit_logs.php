<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <div class="panel-head">
            <div>
                <p class="tag">Audit Trail</p>
                <h1>Audit Logs</h1>
            </div>
            <p class="muted">MVP audit entries should include login, logout, upload, approval, download, update, and archive actions.</p>
        </div>
        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>When</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Entity</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr>
                            <td colspan="5">No audit log entries are stored yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?= esc($log['created_at']) ?></td>
                                <td><?= esc($log['user_name'] ?? 'System') ?></td>
                                <td><?= esc($log['action']) ?></td>
                                <td><?= esc(($log['entity_type'] ?? 'n/a') . (! empty($log['entity_id']) ? ' #' . $log['entity_id'] : '')) ?></td>
                                <td><?= esc($log['details'] ?: 'No details') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <aside class="panel">
        <p class="tag">Expected Coverage</p>
        <h2>Track these events</h2>
        <ul class="stack-list">
            <?php foreach (($expectedEvents ?? []) as $event): ?>
                <li><?= esc($event) ?></li>
            <?php endforeach; ?>
        </ul>
    </aside>
</section>
<?= $this->endSection() ?>
