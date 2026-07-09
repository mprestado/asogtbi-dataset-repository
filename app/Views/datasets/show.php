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
    </dl>
    <div class="actions">
        <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download ZIP</a>
        <a class="button" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit</a>
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
        <h2>Repository Context</h2>
        <p class="muted">This record is coming from the approved dataset catalog and respects the same public filter conditions as the browse page.</p>
    </div>
</section>
<?= $this->endSection() ?>
