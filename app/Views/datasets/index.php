<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="browse-hero">
    <div class="shell browse-hero-inner">
        <p class="eyebrow">Repository Catalog</p>
        <h1>Browse Repository</h1>
        <p>Explore our collection of research papers, theses, datasets, and academic publications.</p>
    </div>
</section>

<section class="browse-stage">
    <div class="shell browse-layout">
        <aside class="filter-panel" aria-label="Dataset filters">
            <h2>Filters</h2>
            <form class="filter-form" method="get" action="<?= site_url('datasets') ?>">
                <div class="filter-search">
                    <label class="sr-only" for="catalog-search">Search dataset</label>
                    <input id="catalog-search" name="q" type="search" placeholder="Search dataset">
                    <button type="submit" aria-label="Search datasets"><span class="search-glyph" aria-hidden="true"></span></button>
                </div>

                <div class="filter-stack">
                    <details>
                        <summary>Departments</summary>
                        <div class="filter-options">
                            <label><input type="checkbox" name="department[]" value="cics"> College of Computer Studies</label>
                            <label><input type="checkbox" name="department[]" value="engineering"> College of Engineering</label>
                            <label><input type="checkbox" name="department[]" value="agriculture"> Agriculture Research</label>
                        </div>
                    </details>
                    <details>
                        <summary>Paper Type</summary>
                        <div class="filter-options">
                            <label><input type="checkbox" name="paper_type[]" value="thesis"> Thesis</label>
                            <label><input type="checkbox" name="paper_type[]" value="capstone"> Capstone</label>
                            <label><input type="checkbox" name="paper_type[]" value="faculty"> Faculty Research</label>
                        </div>
                    </details>
                    <details>
                        <summary>Task</summary>
                        <div class="filter-options">
                            <label><input type="checkbox" name="task[]" value="classification"> Classification</label>
                            <label><input type="checkbox" name="task[]" value="prediction"> Prediction</label>
                            <label><input type="checkbox" name="task[]" value="analysis"> Analysis</label>
                        </div>
                    </details>
                    <details>
                        <summary>Data Type</summary>
                        <div class="filter-options">
                            <label><input type="checkbox" name="data_type[]" value="text"> Text</label>
                            <label><input type="checkbox" name="data_type[]" value="image"> Image</label>
                            <label><input type="checkbox" name="data_type[]" value="audio"> Audio</label>
                            <label><input type="checkbox" name="data_type[]" value="tabular"> Tabular</label>
                        </div>
                    </details>
                </div>
            </form>
        </aside>

        <div class="dataset-results" aria-label="Dataset results">
            <?php
                $datasets = [
                    [
                        'title' => 'Machine Learning Applications in Agricultural Productivity',
                        'author' => 'Dr. Maria Santos',
                        'date' => '12/15/2025',
                        'description' => 'This study explores the implementation of machine learning algorithms to predict crop yields and optimize farming practices in the Bicol region.',
                        'views' => '1230',
                        'downloads' => '245',
                    ],
                    [
                        'title' => 'Text Mining Patterns in Local Startup Reports',
                        'author' => 'Prof. Anton Reyes',
                        'date' => '11/08/2025',
                        'description' => 'A curated dataset of anonymized startup reports prepared for natural language processing, document classification, and trend discovery experiments.',
                        'views' => '980',
                        'downloads' => '188',
                    ],
                    [
                        'title' => 'Computer Vision Dataset for Food Quality Inspection',
                        'author' => 'Engr. Liza Mercado',
                        'date' => '10/22/2025',
                        'description' => 'Image samples and metadata designed for object detection and quality inspection workflows in local food processing environments.',
                        'views' => '1412',
                        'downloads' => '302',
                    ],
                    [
                        'title' => 'Geospatial Indicators for Community Flood Mapping',
                        'author' => 'Dr. Paolo Dizon',
                        'date' => '09/19/2025',
                        'description' => 'Spatial indicators, tagged observations, and supporting references for flood-risk mapping and climate resilience research.',
                        'views' => '856',
                        'downloads' => '129',
                    ],
                ];
            ?>

            <?php foreach ($datasets as $index => $dataset): ?>
                <article class="dataset-result-card">
                    <div class="dataset-thumb" aria-hidden="true">
                        <span></span>
                    </div>
                    <div class="dataset-result-copy">
                        <h2><?= esc($dataset['title']) ?></h2>
                        <div class="dataset-meta">
                            <span>By <?= esc($dataset['author']) ?></span>
                            <span><?= esc($dataset['date']) ?></span>
                        </div>
                        <p><?= esc($dataset['description']) ?></p>
                        <div class="dataset-stats">
                            <span><?= esc($dataset['views']) ?> views</span>
                            <span><?= esc($dataset['downloads']) ?> downloads</span>
                        </div>
                        <div class="dataset-card-actions">
                            <a class="button button-preview" href="<?= site_url('datasets/' . ($index + 1)) ?>">Preview</a>
                            <a class="button button-download" href="<?= site_url('datasets/' . ($index + 1) . '/download') ?>">Downloads</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
