<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="panel">
    <h1>Edit Dataset #<?= esc((string) $datasetId) ?></h1>
    <form method="post" action="<?= site_url('datasets/' . $datasetId . '/update') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <label for="title">Title</label>
        <input id="title" name="title">

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5"></textarea>

        <label for="dataset_file">New ZIP version</label>
        <input id="dataset_file" type="file" name="dataset_file" accept=".zip">

        <div class="actions">
            <button class="button" type="submit">Update Dataset</button>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
