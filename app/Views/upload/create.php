<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="shell split-grid">
    <section class="panel">
        <p class="tag">Dataset Lifecycle</p>
        <h1>Upload Dataset</h1>
        <p class="muted">This form reflects the MVP metadata requirements from the docs. Server-side validation, protected ZIP storage under `writable/uploads`, and audit logging still need backend implementation.</p>
        <form method="post" action="<?= site_url('upload') ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="grid">
                <div>
                    <label for="title">Dataset Title</label>
                    <input id="title" name="title">
                </div>
                <div>
                    <label for="category">Category</label>
                    <input id="category" name="category">
                </div>
                <div>
                    <label for="data_type">Data Type</label>
                    <select id="data_type" name="data_type">
                        <?php foreach (($dataTypes ?? []) as $dataType): ?>
                            <option value="<?= esc($dataType) ?>"><?= esc($dataType) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="file_format">File Format</label>
                    <input id="file_format" name="file_format" value="ZIP">
                </div>
                <div>
                    <label for="source_type">Source Type</label>
                    <select id="source_type" name="source_type">
                        <?php foreach (($sourceTypes ?? []) as $sourceType): ?>
                            <option value="<?= esc($sourceType) ?>"><?= esc($sourceType) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="access_type">Access Type</label>
                    <select id="access_type" name="access_type">
                        <?php foreach (($accessTypes ?? []) as $accessType): ?>
                            <option value="<?= esc($accessType) ?>"><?= esc(ucfirst($accessType)) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4"></textarea>

            <label for="tags">Tags</label>
            <input id="tags" name="tags" placeholder="startup, survey, tabular">

            <label for="research_title">Research Title</label>
            <input id="research_title" name="research_title">

            <label for="project_head">Project Head or Adviser</label>
            <input id="project_head" name="project_head">

            <label for="members">Research Members or Contributors</label>
            <textarea id="members" name="members" rows="3" placeholder="List the student researchers, faculty collaborators, or project contributors"></textarea>

            <label for="source_link">Source Link</label>
            <input id="source_link" name="source_link" placeholder="Optional reference URL for the dataset source">

            <label for="dataset_file">Dataset ZIP File</label>
            <input id="dataset_file" type="file" name="dataset_file" accept=".zip">

            <div class="actions">
                <button class="button" type="submit">Submit for Approval</button>
            </div>
        </form>
    </section>

    <aside class="panel">
        <p class="tag">Required Metadata</p>
        <h2>Submission checklist</h2>
        <ul class="stack-list">
            <?php foreach (($requiredMetadata ?? []) as $metadata): ?>
                <li><?= esc($metadata) ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Expected status flow</h3>
        <p class="muted">Submitted datasets should move into pending review before they become visible in the approved public catalog.</p>
    </aside>
</section>
<?= $this->endSection() ?>
