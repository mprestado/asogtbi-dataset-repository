<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Dataset Lifecycle</p>
        <h1>Upload a Dataset</h1>
        <p class="lead">Submit metadata and a protected ZIP package. New submissions begin with Research Ethics verification.</p>
    </div>
</section>

<section class="shell split-grid form-shell">
    <section class="form-card">
        <div class="panel-head">
            <div>
                <p class="tag">Submission Form</p>
                <h2>Dataset metadata</h2>
            </div>
            <span class="status-pill status-pending_ethics_review">Pending Ethics Review</span>
        </div>

        <form method="post" action="<?= site_url('upload') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <p class="tag">Dataset Info</p>
            <div class="grid">
                <div>
                    <label for="title">Dataset Title</label>
                    <input id="title" name="title" value="<?= old('title') ?>" placeholder="e.g., Startup Survey Responses">
                </div>
                <div>
                    <label for="category">Category</label>
                    <input id="category" name="category" value="<?= old('category') ?>" placeholder="Startup Research">
                </div>
                <div>
                    <label for="data_type">Data Type</label>
                    <select id="data_type" name="data_type">
                        <?php foreach (($dataTypes ?? []) as $dataType): ?>
                            <option value="<?= esc($dataType) ?>" <?= old('data_type') === $dataType ? 'selected' : '' ?>><?= esc($dataType) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="file_format">File Format</label>
                    <input id="file_format" name="file_format" value="<?= old('file_format', 'ZIP') ?>">
                </div>
                <div>
                    <label for="access_type">Access Type</label>
                    <select id="access_type" name="access_type">
                        <?php foreach (($accessTypes ?? []) as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= old('access_type', 'public') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Describe what the dataset contains and how it may be used."><?= old('description') ?></textarea>

            <label for="tags">Tags</label>
            <input id="tags" name="tags" value="<?= old('tags') ?>" placeholder="startup, survey, tabular">

            <p class="tag form-section-label">Research Info</p>
            <label for="research_title">Research Title</label>
            <input id="research_title" name="research_title" value="<?= old('research_title') ?>">

            <label for="project_head">Project Head or Adviser</label>
            <input id="project_head" name="project_head" value="<?= old('project_head') ?>">

            <label for="members">Research Members or Contributors</label>
            <textarea id="members" name="members" rows="3" placeholder="List student researchers, faculty collaborators, incubatees, or project contributors."><?= old('members') ?></textarea>

            <p class="tag form-section-label">Source and File</p>
            <label for="source_type">Source Type</label>
            <select id="source_type" name="source_type">
                <?php foreach (($sourceTypes ?? []) as $sourceType): ?>
                    <option value="<?= esc($sourceType) ?>" <?= old('source_type') === $sourceType ? 'selected' : '' ?>><?= esc($sourceType) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="source_link">Source Link</label>
            <input id="source_link" name="source_link" value="<?= old('source_link') ?>" placeholder="Optional reference URL for the dataset source">

            <label for="dataset_file">Dataset ZIP File</label>
            <div class="file-zone">
                <strong>Upload protected ZIP package</strong>
                <p class="muted">ZIP only, maximum 10 MB for the MVP upload flow.</p>
                <input id="dataset_file" type="file" name="dataset_file" accept=".zip">
            </div>

            <label class="checkbox-row" for="anonymized">
                <input id="anonymized" type="checkbox" name="anonymized" value="1" <?= old('anonymized') ? 'checked' : '' ?>>
                <span>I confirm sensitive or personal data has been anonymized before submission.</span>
            </label>

            <div class="actions">
                <button class="button" type="submit">Submit for Review</button>
                <a class="button secondary" href="<?= site_url('dashboard') ?>">Cancel</a>
            </div>
        </form>
    </section>

    <aside class="panel detail-sidebar">
        <p class="tag">Submission Checklist</p>
        <h2>Before uploading</h2>
        <ul class="stack-list">
            <?php foreach (($requiredMetadata ?? []) as $metadata): ?>
                <li><?= esc($metadata) ?></li>
            <?php endforeach; ?>
            <li>Anonymization confirmation</li>
        </ul>
        <h3>What happens next</h3>
        <p class="muted">This website creates the dataset as Pending Review. Approval, rejection, and review notes are handled outside this codebase by the Admin Portal.</p>
    </aside>
</section>
<?= $this->endSection() ?>
