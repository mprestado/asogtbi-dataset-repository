<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Dataset Catalog</h1>
    <p class="muted">Member 4 will connect approved datasets, pagination, search, and filtering here.</p>
    <form method="get" action="<?= site_url('datasets') ?>">
        <div class="grid">
            <div>
                <label for="q">Search</label>
                <input id="q" name="q" placeholder="Title, description, tags, category">
            </div>
            <div>
                <label for="data_type">Data Type</label>
                <select id="data_type" name="data_type">
                    <option value="">All</option>
                    <option>Tabular</option>
                    <option>Text</option>
                    <option>Image</option>
                    <option>Audio</option>
                    <option>Video</option>
                </select>
            </div>
        </div>
        <div class="actions">
            <button class="button" type="submit">Search</button>
        </div>
    </form>
</section>

<section class="panel">
    <h2>Sample Dataset Card</h2>
    <p class="muted">Replace this with database-driven cards for approved, non-archived datasets.</p>
    <a class="button" href="<?= site_url('datasets/1') ?>">View Details</a>
</section>
<?= $this->endSection() ?>
