<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <p class="tag">Dataset Revision</p>
        <h1>Edit Dataset #<?= esc((string) $datasetId) ?></h1>
        <p class="muted">Authorized users should be able to update metadata, optionally upload a new ZIP version, and archive records that should leave the normal catalog.</p>
        <form method="post" action="<?= site_url('datasets/' . $datasetId . '/update') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="grid">
                <div>
                    <label for="title">Title</label>
                    <input id="title" name="title" value="<?= esc($dataset['title'] ?? '') ?>">
                </div>
                <div>
                    <label for="category">Category</label>
                    <input id="category" name="category" value="<?= esc($dataset['category'] ?? '') ?>">
                </div>
                <div>
                    <label for="data_type">Data Type</label>
                    <select id="data_type" name="data_type">
                        <?php foreach (($dataTypes ?? []) as $dataType): ?>
                            <option value="<?= esc($dataType) ?>" <?= ($dataset['data_type'] ?? '') === $dataType ? 'selected' : '' ?>><?= esc($dataType) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="access_type">Access Type</label>
                    <select id="access_type" name="access_type">
                        <?php foreach (($accessTypes ?? []) as $accessType): ?>
                            <option value="<?= esc($accessType) ?>" <?= ($dataset['access_type'] ?? '') === $accessType ? 'selected' : '' ?>><?= esc(ucfirst($accessType)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5"><?= esc($dataset['description'] ?? '') ?></textarea>

            <label for="tags">Tags</label>
            <input id="tags" name="tags" value="<?= esc($dataset['tags'] ?? '') ?>">

            <label for="research_title">Research Title</label>
            <input id="research_title" name="research_title" value="<?= esc($dataset['research_title'] ?? '') ?>">

            <label for="project_head">Project Head or Adviser</label>
            <input id="project_head" name="project_head" value="<?= esc($dataset['project_head'] ?? '') ?>">

            <label for="members">Research Members or Contributors</label>
            <textarea id="members" name="members" rows="3"><?= esc($dataset['members'] ?? '') ?></textarea>

            <label for="source_type">Source Type</label>
            <select id="source_type" name="source_type">
                <?php foreach (($sourceTypes ?? []) as $sourceType): ?>
                    <option value="<?= esc($sourceType) ?>" <?= ($dataset['source_type'] ?? '') === $sourceType ? 'selected' : '' ?>><?= esc($sourceType) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="source_link">Source Link</label>
            <input id="source_link" name="source_link" value="<?= esc($dataset['source_link'] ?? '') ?>">

            <label for="change_summary">Change Summary</label>
            <textarea id="change_summary" name="change_summary" rows="3" placeholder="Describe what changed in this revision"></textarea>

            <label for="dataset_file">New ZIP version</label>
            <input id="dataset_file" type="file" name="dataset_file" accept=".zip">

            <div class="actions">
                <button class="button" type="submit">Update Dataset</button>
            </div>
        </form>
    </section>

    <aside class="panel">
        <p class="tag">Current Record</p>
        <h2>Metadata snapshot</h2>
        <ul class="record-list">
            <li><strong>Status</strong><span class="muted"><?= esc($dataset['status'] ?? 'unknown') ?></span></li>
            <li><strong>Version</strong><span class="muted"><?= esc($dataset['version'] ?? '1.0') ?></span></li>
            <li><strong>File format</strong><span class="muted"><?= esc($dataset['file_format'] ?? 'ZIP') ?></span></li>
        </ul>
        <form method="post" action="<?= site_url('datasets/' . $datasetId . '/archive') ?>">
            <?= csrf_field() ?>
            <div class="actions">
                <button class="button warning" type="submit">Archive Dataset</button>
            </div>
        </form>
    </aside>
</section>
<?= $this->endSection() ?>
