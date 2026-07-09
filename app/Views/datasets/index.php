<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Dataset Catalog</h1>
    <p class="muted">Search and filter approved datasets by metadata that already exists in the repository.</p>
    <form method="get" action="<?= site_url('datasets') ?>">
        <div class="grid">
            <div>
                <label for="q">Search</label>
                <input id="q" name="q" value="<?= esc($search ?? '') ?>" placeholder="Title, description, tags, category">
            </div>
            <div>
                <label for="data_type">Data Type</label>
                <select id="data_type" name="data_type">
                    <option value="">All</option>
                    <?php foreach (['Tabular', 'Text', 'Image', 'Audio', 'Video'] as $dataType): ?>
                        <option value="<?= esc($dataType) ?>" <?= ($selectedDataType ?? '') === $dataType ? 'selected' : '' ?>>
                            <?= esc($dataType) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All</option>
                    <?php foreach (($categories ?? []) as $category): ?>
                        <option value="<?= esc($category) ?>" <?= ($selectedCategory ?? '') === $category ? 'selected' : '' ?>>
                            <?= esc($category) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="actions">
            <button class="button" type="submit">Search</button>
            <a class="button secondary" href="<?= site_url('datasets') ?>">Reset</a>
        </div>
    </form>
</section>

<section class="panel">
    <h2>Results</h2>
    <?php if (empty($datasets)): ?>
        <p class="muted">No approved datasets matched the current search and filter values.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($datasets as $dataset): ?>
                <article class="panel">
                    <p class="tag"><?= esc($dataset['data_type'] ?: 'Dataset') ?></p>
                    <h3><?= esc($dataset['title']) ?></h3>
                    <p class="muted"><?= esc($dataset['description']) ?></p>
                    <dl class="meta-list">
                        <div>
                            <dt>Category</dt>
                            <dd><?= esc($dataset['category'] ?: 'Uncategorized') ?></dd>
                        </div>
                        <div>
                            <dt>Tags</dt>
                            <dd><?= esc($dataset['tags'] ?: 'No tags') ?></dd>
                        </div>
                        <div>
                            <dt>Author</dt>
                            <dd><?= esc($dataset['author_name'] ?? 'Unknown author') ?></dd>
                        </div>
                    </dl>
                    <div class="actions">
                        <a class="button" href="<?= site_url('datasets/' . $dataset['id']) ?>">View Details</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($pager)): ?>
        <div class="actions">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>
