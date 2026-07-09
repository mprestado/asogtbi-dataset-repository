<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1><?= esc($dataset['title']) ?></h1>
    <p class="muted">Approved dataset record #<?= esc((string) $datasetId) ?></p>
    <dl class="meta-list">
        <div>
        <dt>Category</dt>
        <dd><?= esc($dataset['category'] ?: 'Uncategorized') ?></dd>
        </div>
        <div>
        <dt>Data Type</dt>
        <dd><?= esc($dataset['data_type'] ?: 'Not set') ?></dd>
        </div>
        <div>
        <dt>Tags</dt>
        <dd><?= esc($dataset['tags'] ?: 'No tags') ?></dd>
        </div>
        <div>
        <dt>Description</dt>
        <dd><?= esc($dataset['description']) ?></dd>
        </div>
        <div>
        <dt>Research Title</dt>
        <dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd>
        </div>
        <div>
        <dt>Project Head</dt>
        <dd><?= esc($dataset['project_head'] ?: 'Not set') ?></dd>
        </div>
        <div>
        <dt>Author</dt>
        <dd><?= esc($dataset['author_name'] ?? 'Unknown author') ?></dd>
        </div>
        <div>
        <dt>Views</dt>
        <dd><?= esc((string) ($viewCount ?? 0)) ?></dd>
        </div>
        <div>
        <dt>Downloads</dt>
        <dd><?= esc((string) ($downloadCount ?? 0)) ?></dd>
        </div>
        <div>
        <dt>Access Type</dt>
        <dd><?= esc($dataset['access_type'] ?? 'public') ?></dd>
        </div>
    </dl>
    <div class="actions">
        <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download ZIP</a>
        <?php if (! empty($canEdit)): ?>
            <a class="button secondary" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit</a>
        <?php endif; ?>
    </div>
</section>

<section class="grid">
    <div class="panel">
        <h2>Citation</h2>
        <pre><?= esc(dataset_citation(['title' => $dataset['title']])) ?></pre>
    </div>
    <div class="panel">
        <h2>BibTeX</h2>
        <pre><?= esc(dataset_bibtex(['title' => $dataset['title']])) ?></pre>
    </div>
    <div class="panel">
        <h2>File Record</h2>
        <?php if (empty($latestFile)): ?>
            <p class="muted">No stored dataset file is available yet.</p>
        <?php else: ?>
            <dl class="meta-list">
                <div>
                    <dt>Original Name</dt>
                    <dd><?= esc($latestFile['original_name']) ?></dd>
                </div>
                <div>
                    <dt>File Type</dt>
                    <dd><?= esc($latestFile['file_type']) ?></dd>
                </div>
                <div>
                    <dt>File Size</dt>
                    <dd><?= esc(number_format((int) $latestFile['file_size'])) ?> bytes</dd>
                </div>
            </dl>
        <?php endif; ?>
    </div>
    <div class="panel">
        <h2>Recommendations</h2>
        <?php if (empty($recommendations)): ?>
            <p class="muted">No metadata-based recommendations are available yet.</p>
        <?php else: ?>
            <ul class="record-list">
                <?php foreach ($recommendations as $recommended): ?>
                    <li>
                        <strong><a href="<?= site_url('datasets/' . $recommended['id']) ?>"><?= esc($recommended['title']) ?></a></strong>
                        <span class="muted"><?= esc($recommended['category']) ?> · score <?= esc((string) $recommended['score']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>
