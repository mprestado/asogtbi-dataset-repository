<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Dataset Detail</p>
        <h1><?= esc($dataset['title']) ?></h1>
        <p class="lead"><?= esc($dataset['category'] ?: 'Uncategorized') ?> &middot; <?= esc($dataset['data_type'] ?: 'Dataset') ?> &middot; <?= esc($accessLabel ?? 'Public') ?></p>
        <?php if (! empty($isOwner)): ?>
            <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>"><?= esc($statusLabel ?? 'Unknown') ?></span>
        <?php endif; ?>
    </div>
</section>

<section class="shell split-grid form-shell">
    <article class="panel">
        <p class="tag">Metadata</p>
        <h2>Description</h2>
        <p><?= esc($dataset['description']) ?></p>
        <dl class="meta-list">
            <div>
                <dt>Research Title</dt>
                <dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd>
            </div>
            <div>
                <dt>Project Head</dt>
                <dd><?= esc($dataset['project_head'] ?: 'Not set') ?></dd>
            </div>
            <div>
                <dt>Members</dt>
                <dd><?= esc($dataset['members'] ?: 'Not listed') ?></dd>
            </div>
            <div>
                <dt>Source</dt>
                <dd><?= esc($dataset['source_type'] ?: 'Not set') ?><?= ! empty($dataset['source_link']) ? ' - ' . esc($dataset['source_link']) : '' ?></dd>
            </div>
            <div>
                <dt>Tags</dt>
                <dd><?= esc($dataset['tags'] ?: 'No tags') ?></dd>
            </div>
        </dl>
    </article>

    <aside class="panel detail-sidebar">
        <p class="tag">Dataset File</p>
        <h2>Download and cite</h2>
        <dl class="meta-list">
            <div>
                <dt>Contributor</dt>
                <dd><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></dd>
            </div>
            <div>
                <dt>Version</dt>
                <dd><?= esc($dataset['version'] ?? '1.0') ?></dd>
            </div>
            <div>
                <dt>Views</dt>
                <dd><?= esc((string) ($viewCount ?? 0)) ?></dd>
            </div>
            <div>
                <dt>Downloads</dt>
                <dd><?= esc((string) ($downloadCount ?? 0)) ?></dd>
            </div>
            <?php if (! empty($latestFile)): ?>
                <div>
                    <dt>File</dt>
                    <dd><?= esc($latestFile['original_name']) ?> (<?= esc(number_format((int) $latestFile['file_size'])) ?> bytes)</dd>
                </div>
            <?php endif; ?>
        </dl>
        <div class="actions">
            <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download ZIP</a>
            <?php if (! empty($canEdit)): ?>
                <a class="button secondary" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit</a>
            <?php endif; ?>
        </div>
    </aside>
</section>

<section class="shell content-section">
    <div class="grid">
        <div class="panel">
            <p class="tag">Citation</p>
            <h2>Plain text</h2>
            <pre><?= esc(dataset_citation([
                'title' => $dataset['title'],
                'author' => $dataset['author_name'] ?? '',
                'year' => ! empty($dataset['created_at']) ? date('Y', strtotime($dataset['created_at'])) : date('Y'),
            ])) ?></pre>
        </div>
        <div class="panel">
            <p class="tag">Citation</p>
            <h2>BibTeX</h2>
            <pre><?= esc(dataset_bibtex([
                'title' => $dataset['title'],
                'author' => $dataset['author_name'] ?? '',
                'year' => ! empty($dataset['created_at']) ? date('Y', strtotime($dataset['created_at'])) : date('Y'),
            ])) ?></pre>
        </div>
        <div class="panel">
            <p class="tag">Recommendations</p>
            <h2>Similar datasets</h2>
            <?php if (empty($recommendations)): ?>
                <p class="muted">No metadata-based recommendations are available yet.</p>
            <?php else: ?>
                <ul class="record-list">
                    <?php foreach ($recommendations as $recommended): ?>
                        <li>
                            <strong><a href="<?= site_url('datasets/' . $recommended['id']) ?>"><?= esc($recommended['title']) ?></a></strong>
                            <span class="muted"><?= esc($recommended['category']) ?> &middot; score <?= esc((string) $recommended['score']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
