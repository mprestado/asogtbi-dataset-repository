<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <div class="panel-head">
            <div>
                <p class="tag">Review Queue</p>
                <h1>Dataset Approval</h1>
            </div>
            <p class="muted">Administrative approval keeps pending submissions out of the public catalog until review is complete.</p>
        </div>
        <div class="table-shell">
            <table>
                <thead>
                    <tr>
                        <th>Dataset</th>
                        <th>Contributor</th>
                        <th>Category</th>
                        <th>Data Type</th>
                        <th>Status</th>
                        <th>Decision</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendingDatasets)): ?>
                        <tr>
                            <td colspan="6">No pending dataset submissions are available right now.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendingDatasets as $dataset): ?>
                            <tr>
                                <td><?= esc($dataset['title']) ?></td>
                                <td><?= esc($dataset['author_name'] ?? 'Unknown author') ?></td>
                                <td><?= esc($dataset['category']) ?></td>
                                <td><?= esc($dataset['data_type']) ?></td>
                                <td><span class="status-pill"><?= esc($dataset['status']) ?></span></td>
                                <td>
                                    <div class="actions compact-actions">
                                        <form method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/approve') ?>">
                                            <?= csrf_field() ?>
                                            <button class="button" type="submit">Approve</button>
                                        </form>
                                        <form method="post" action="<?= site_url('admin/datasets/' . $dataset['id'] . '/reject') ?>">
                                            <?= csrf_field() ?>
                                            <button class="button secondary" type="submit">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <aside class="panel">
        <p class="tag">Published Snapshot</p>
        <h2>Recently approved datasets</h2>
        <?php if (empty($approvedDatasets)): ?>
            <p class="muted">No approved datasets are available yet.</p>
        <?php else: ?>
            <ul class="record-list">
                <?php foreach ($approvedDatasets as $dataset): ?>
                    <li>
                        <strong><?= esc($dataset['title']) ?></strong>
                        <span class="muted"><?= esc($dataset['author_name'] ?? 'Unknown author') ?> · <?= esc($dataset['category']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </aside>
</section>
<?= $this->endSection() ?>
