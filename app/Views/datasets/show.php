<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Dataset #<?= esc((string) $datasetId) ?></h1>
    <p class="muted">Member 4 will connect full metadata and file records here.</p>
    <dl>
        <dt>Category</dt>
        <dd>Sample category</dd>
        <dt>Data Type</dt>
        <dd>Sample data type</dd>
        <dt>Tags</dt>
        <dd>sample, dataset, mvp</dd>
    </dl>
    <div class="actions">
        <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download ZIP</a>
        <a class="button" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit</a>
    </div>
</section>

<section class="grid">
    <div class="panel">
        <h2>Citation</h2>
        <pre><?= esc(dataset_citation(['title' => 'Sample Dataset'])) ?></pre>
    </div>
    <div class="panel">
        <h2>BibTeX</h2>
        <pre><?= esc(dataset_bibtex(['title' => 'Sample Dataset'])) ?></pre>
    </div>
    <div class="panel">
        <h2>Recommendations</h2>
        <p class="muted">Member 5 will connect metadata-based recommendations here.</p>
    </div>
</section>
<?= $this->endSection() ?>
