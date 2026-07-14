<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php $errors = session()->getFlashdata('errors') ?? []; ?>
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
                    <span class="help-text">A concise, descriptive name for your dataset (max 255 characters)</span>
                    <input id="title" name="title" value="<?= old('title') ?>" placeholder="e.g., Startup Survey Responses" class="<?= !empty($errors['title']) ? 'field-error__input' : '' ?>">
                    <?php if (!empty($errors['title'])): ?><span class="field-error"><?= esc($errors['title']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="category">Category</label>
                    <span class="help-text">e.g., Startup Research, Climate Data, Health Informatics</span>
                    <input id="category" name="category" value="<?= old('category') ?>" placeholder="Startup Research" class="<?= !empty($errors['category']) ? 'field-error__input' : '' ?>">
                    <?php if (!empty($errors['category'])): ?><span class="field-error"><?= esc($errors['category']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="data_type">Data Type</label>
                    <span class="help-text">Select the canonical type that best describes your data</span>
                    <select id="data_type" name="data_type" class="<?= !empty($errors['data_type']) ? 'field-error__input' : '' ?>">
                        <option value="" disabled <?= old('data_type') === '' || old('data_type') === null ? 'selected' : '' ?>>Select a data type</option>
                        <?php foreach (($dataTypes ?? []) as $dataType): ?>
                            <option value="<?= esc($dataType) ?>" <?= old('data_type') === $dataType ? 'selected' : '' ?>><?= esc($dataType) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['data_type'])): ?><span class="field-error"><?= esc($errors['data_type']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="file_format">File Format</label>
                    <span class="help-text">The format of the files inside your ZIP package</span>
                    <input id="file_format" name="file_format" value="<?= old('file_format', 'ZIP') ?>" placeholder="CSV, PDF, JSON" class="<?= !empty($errors['file_format']) ? 'field-error__input' : '' ?>">
                    <?php if (!empty($errors['file_format'])): ?><span class="field-error"><?= esc($errors['file_format']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="access_type">Access Type</label>
                    <span class="help-text">Who should be able to access this dataset once published</span>
                    <select id="access_type" name="access_type">
                        <?php foreach (($accessTypes ?? []) as $value => $label): ?>
                            <option value="<?= esc($value) ?>" <?= old('access_type', 'public') === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['access_type'])): ?><span class="field-error"><?= esc($errors['access_type']) ?></span><?php endif; ?>
                </div>
            </div>

            <label for="description">Description</label>
            <span class="help-text">Describe what the dataset contains, how it was collected, and how it may be used</span>
            <textarea id="description" name="description" rows="4" placeholder="e.g., Survey responses from 120 incubatees covering startup needs, challenges, and resource gaps." class="<?= !empty($errors['description']) ? 'field-error__input' : '' ?>"><?= old('description') ?></textarea>
            <?php if (!empty($errors['description'])): ?><span class="field-error"><?= esc($errors['description']) ?></span><?php endif; ?>

            <label for="tags">Tags</label>
            <span class="help-text">Comma-separated keywords for discoverability — e.g., startup, survey, tabular</span>
            <input id="tags" name="tags" value="<?= old('tags') ?>" placeholder="startup, survey, tabular" class="<?= !empty($errors['tags']) ? 'field-error__input' : '' ?>">
            <?php if (!empty($errors['tags'])): ?><span class="field-error"><?= esc($errors['tags']) ?></span><?php endif; ?>

            <hr class="section-divider">

            <p class="tag form-section-label">Research Info</p>
            <div class="grid">
                <div>
                    <label for="research_title">Research Title</label>
                    <span class="help-text">The official title of the research, thesis, or capstone project</span>
                    <input id="research_title" name="research_title" value="<?= old('research_title') ?>" class="<?= !empty($errors['research_title']) ? 'field-error__input' : '' ?>">
                    <?php if (!empty($errors['research_title'])): ?><span class="field-error"><?= esc($errors['research_title']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="project_head">Project Head or Adviser</label>
                    <span class="help-text">Name of the faculty adviser, project lead, or supervising researcher</span>
                    <input id="project_head" name="project_head" value="<?= old('project_head') ?>" class="<?= !empty($errors['project_head']) ? 'field-error__input' : '' ?>">
                    <?php if (!empty($errors['project_head'])): ?><span class="field-error"><?= esc($errors['project_head']) ?></span><?php endif; ?>
                </div>
            </div>

            <label for="members">Research Members or Contributors</label>
            <span class="help-text">List all student researchers, faculty collaborators, incubatees, or project contributors</span>
            <textarea id="members" name="members" rows="3" placeholder="e.g., Juan Dela Cruz, Maria Santos, Dr. Reyes"><?= old('members') ?></textarea>

            <hr class="section-divider">

            <p class="tag form-section-label">Source and File</p>
            <div class="grid">
                <div>
                    <label for="source_type">Source Type</label>
                    <span class="help-text">Primary = original data collected by your team. Secondary = data from existing sources.</span>
                    <select id="source_type" name="source_type">
                        <?php foreach (($sourceTypes ?? []) as $sourceType): ?>
                            <option value="<?= esc($sourceType) ?>" <?= old('source_type') === $sourceType ? 'selected' : '' ?>><?= esc($sourceType) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['source_type'])): ?><span class="field-error"><?= esc($errors['source_type']) ?></span><?php endif; ?>
                </div>
                <div>
                    <label for="source_link">Source Link</label>
                    <span class="help-text">Optional — provide a URL to the original data source or related publication</span>
                    <input id="source_link" name="source_link" value="<?= old('source_link') ?>" placeholder="https://doi.org/...">
                </div>
            </div>

            <label for="dataset_file">Dataset ZIP File</label>
            <span class="help-text">Upload a single ZIP file containing your dataset and any supporting documentation</span>

            <div class="file-zone" id="file-zone">
                <input type="file" id="dataset_file" name="dataset_file" accept=".zip" hidden>
                <?php if (!empty($errors['dataset_file'])): ?>
                    <span class="field-error" style="margin-bottom:8px;display:block"><?= esc($errors['dataset_file']) ?></span>
                <?php endif; ?>
                <div class="file-zone__placeholder" id="file-placeholder">
                    <strong>Upload protected ZIP package</strong>
                    <p class="muted">ZIP only, maximum 10 MB</p>
                    <button type="button" class="button" id="file-trigger">Select ZIP File</button>
                </div>
                <div class="file-zone__preview" id="file-preview" hidden>
                    <span class="file-zone__icon">ZIP</span>
                    <span class="file-zone__name" id="file-name"></span>
                    <span class="file-zone__size muted" id="file-size"></span>
                    <button type="button" class="button secondary" id="file-clear" title="Remove selected file">Remove</button>
                </div>
            </div>

            <div class="anonymization-card">
                <p class="tag">Ethics Requirement</p>
                <label class="checkbox-row" for="anonymized">
                    <input id="anonymized" type="checkbox" name="anonymized" value="1" <?= old('anonymized') ? 'checked' : '' ?>>
                    <span>I confirm that all sensitive or personal data has been anonymized before submission.</span>
                </label>
                <?php if (!empty($errors['anonymized'])): ?><span class="field-error" style="margin-top:8px;display:block"><?= esc($errors['anonymized']) ?></span><?php endif; ?>
            </div>

            <div class="actions" style="margin-top:28px">
                <button class="button" type="submit">Submit for Review</button>
                <a class="button secondary" href="<?= site_url('dashboard') ?>">Cancel</a>
            </div>
        </form>
    </section>

    <aside class="panel detail-sidebar">
        <p class="tag">Submission Checklist</p>
        <h2>Before Uploading</h2>
        <ul class="stack-list">
            <?php foreach (($requiredMetadata ?? []) as $metadata): ?>
                <li><?= esc($metadata) ?></li>
            <?php endforeach; ?>
            <li>Anonymization confirmation</li>
        </ul>
        <h3>What Happens Next?</h3>
        <p class="muted">Your dataset is created as Pending Review. A repository administrator assigns an ethics reviewer, then a technical reviewer. You will be notified at each stage.</p>
    </aside>
</section>

<script>
(function() {
    var fileInput = document.getElementById('dataset_file');
    var fileTrigger = document.getElementById('file-trigger');
    var fileZone = document.getElementById('file-zone');
    var filePreview = document.getElementById('file-preview');
    var filePlaceholder = document.getElementById('file-placeholder');
    var fileName = document.getElementById('file-name');
    var fileSize = document.getElementById('file-size');
    var fileClear = document.getElementById('file-clear');

    if (!fileInput || !fileTrigger) return;

    fileTrigger.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length === 0) return;
        var file = fileInput.files[0];
        fileName.textContent = file.name;
        fileSize.textContent = '(' + (file.size / 1024 / 1024).toFixed(1) + ' MB)';
        filePlaceholder.hidden = true;
        filePreview.hidden = false;
        fileZone.classList.add('file-zone--has-file');
    });

    if (fileClear) {
        fileClear.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.value = '';
            filePlaceholder.hidden = false;
            filePreview.hidden = true;
            fileZone.classList.remove('file-zone--has-file');
        });
    }

    fileZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileZone.classList.add('file-zone--dragover');
    });

    fileZone.addEventListener('dragleave', function() {
        fileZone.classList.remove('file-zone--dragover');
    });

    fileZone.addEventListener('drop', function(e) {
        e.preventDefault();
        fileZone.classList.remove('file-zone--dragover');
        if (e.dataTransfer.files.length > 0) {
            fileInput.files = e.dataTransfer.files;
            if (fileInput.files[0]) {
                var event = new Event('change', { bubbles: true });
                fileInput.dispatchEvent(event);
            }
        }
    });
})();
</script>
<?= $this->endSection() ?>