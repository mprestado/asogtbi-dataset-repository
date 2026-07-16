<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Dataset Revision</p>
        <h1>Edit Dataset</h1>
        <p class="lead">Update your dataset metadata or upload a new ZIP version. Revision-requested records return to Pending Review when saved.</p>
        <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>"><?= esc($statusLabel ?? 'Unknown') ?></span>
    </div>
</section>

<section class="shell split-grid form-shell">
    <section class="form-card">
        <div class="panel-head">
            <div>
                <p class="tag">Dataset Metadata</p>
                <h2><?= esc($dataset['title'] ?? 'Dataset') ?></h2>
            </div>
        </div>

        <form method="post" action="<?= site_url('datasets/' . $datasetId . '/update') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="grid">
                <div>
                    <label for="title">Title</label>
                    <input id="title" name="title" value="<?= old('title', $dataset['title'] ?? '') ?>">
                </div>
                <div>
                    <label for="category">Category</label>
                    <input id="category" name="category" value="<?= old('category', $dataset['category'] ?? '') ?>">
                </div>
                <div>
                    <label for="data_type">Data Type</label>
                    <select id="data_type" name="data_type">
                        <?php foreach (($dataTypes ?? []) as $dataType): ?>
                            <option value="<?= esc($dataType) ?>" <?= old('data_type', $dataset['data_type'] ?? '') === $dataType ? 'selected' : '' ?>><?= esc($dataType) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="file_format">File Format</label>
                    <input id="file_format" name="file_format" value="<?= old('file_format', $dataset['file_format'] ?? 'ZIP') ?>">
                </div>
                <div>
                    <label for="access_type">Access Type</label>
                    <select id="access_type" name="access_type">
                        <?php foreach (($accessTypes ?? []) as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= old('access_type', $dataset['access_type'] ?? 'public') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5"><?= old('description', $dataset['description'] ?? '') ?></textarea>

            <label for="cover_image">Dataset Cover <span class="label-optional">(OPTIONAL)</span></label>
            <span class="help-text">Upload a JPG, PNG, or WebP image up to 4 MB to replace the current catalog cover.</span>
            <div class="cover-upload-control">
                <img
                    class="cover-upload-preview"
                    id="cover-preview"
                    src="<?= esc(dataset_cover_url($dataset), 'attr') ?>"
                    alt="Current cover for <?= esc($dataset['title'] ?? 'dataset', 'attr') ?>"
                >
                <div class="cover-upload-copy">
                    <strong>Current catalog cover</strong>
                    <p class="muted">Leave this empty to keep the current image. Existing datasets without a cover use the repository placeholder.</p>
                    <input id="cover_image" type="file" name="cover_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                    <button class="button secondary cover-clear-button" id="cover-clear" type="button" hidden>Keep current cover</button>
                </div>
            </div>

            <label for="tags">Tags</label>
            <input id="tags" name="tags" value="<?= old('tags', $dataset['tags'] ?? '') ?>">

            <label for="research_title">Research Title</label>
            <input id="research_title" name="research_title" value="<?= old('research_title', $dataset['research_title'] ?? '') ?>">

            <label for="project_head">Project Head or Adviser</label>
            <input id="project_head" name="project_head" value="<?= old('project_head', $dataset['project_head'] ?? '') ?>">

            <label for="members">Research Members or Contributors</label>
            <textarea id="members" name="members" rows="3"><?= old('members', $dataset['members'] ?? '') ?></textarea>

            <label for="source_type">Source Type</label>
            <select id="source_type" name="source_type">
                <?php foreach (($sourceTypes ?? []) as $sourceType): ?>
                    <option value="<?= esc($sourceType) ?>" <?= old('source_type', $dataset['source_type'] ?? '') === $sourceType ? 'selected' : '' ?>><?= esc($sourceType) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="source_link">Source Link</label>
            <input id="source_link" name="source_link" value="<?= old('source_link', $dataset['source_link'] ?? '') ?>">

            <label for="change_summary">Change Summary</label>
            <textarea id="change_summary" name="change_summary" rows="3" placeholder="Describe what changed in this revision"><?= old('change_summary') ?></textarea>

            <label for="dataset_file">New ZIP version</label>
            <div class="file-zone">
                <strong>Optional file replacement</strong>
                <p class="muted">Upload a new ZIP package only when the dataset file changed.</p>
                <input id="dataset_file" type="file" name="dataset_file" accept=".zip">
            </div>

            <div class="actions">
                <button class="button" type="submit">Update Dataset</button>
                <a class="button secondary" href="<?= site_url('dashboard') ?>">Back to My Datasets</a>
            </div>
        </form>
    </section>

    <aside class="panel detail-sidebar">
        <p class="tag">Current Record</p>
        <h2>Metadata snapshot</h2>
        <ul class="record-list">
            <li><strong>Status</strong><span class="muted"><?= esc($statusLabel ?? 'Unknown') ?></span></li>
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
<script>
(() => {
    const input = document.getElementById('cover_image');
    const preview = document.getElementById('cover-preview');
    const clear = document.getElementById('cover-clear');
    if (!input || !preview || !clear) return;

    const currentCover = preview.src;
    let objectUrl = null;

    input.addEventListener('change', () => {
        if (objectUrl) URL.revokeObjectURL(objectUrl);
        if (input.files.length === 0) {
            preview.src = currentCover;
            clear.hidden = true;
            return;
        }

        objectUrl = URL.createObjectURL(input.files[0]);
        preview.src = objectUrl;
        clear.hidden = false;
    });

    clear.addEventListener('click', () => {
        if (objectUrl) URL.revokeObjectURL(objectUrl);
        objectUrl = null;
        input.value = '';
        preview.src = currentCover;
        clear.hidden = true;
    });
})();
</script>
<?= $this->endSection() ?>
