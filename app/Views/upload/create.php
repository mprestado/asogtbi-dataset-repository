<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Upload Dataset</h1>
    <p class="muted">The team will connect validation, ZIP storage, pending status, and audit logging here.</p>
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
                    <option>Tabular</option>
                    <option>Text</option>
                    <option>Image</option>
                    <option>Audio</option>
                    <option>Video</option>
                </select>
            </div>
            <div>
                <label for="file_format">File Format</label>
                <input id="file_format" name="file_format" value="ZIP">
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

        <label for="dataset_file">Dataset ZIP File</label>
        <input id="dataset_file" type="file" name="dataset_file" accept=".zip">

        <div class="actions">
            <button class="button" type="submit">Submit for Approval</button>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
