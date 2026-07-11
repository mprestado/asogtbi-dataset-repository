<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="landing-hero">
    <div class="shell hero-content">
        <p class="eyebrow">CSPC + ASOG Technology Business Incubator</p>
        <h1>ASOG TBI <em>Dataset Repository</em></h1>
        <p>Discover, cite, download, and contribute institutional datasets for thesis, capstone, research, AI/ML, analytics, and startup development.</p>

        <form class="hero-search" method="get" action="<?= site_url('datasets') ?>">
            <label class="sr-only" for="home-search">Search datasets</label>
            <input id="home-search" name="q" placeholder="Search datasets, tags, categories, file formats">
            <button type="submit">Search</button>
        </form>

        <div class="hero-actions">
            <a class="button secondary" href="<?= site_url('datasets') ?>">Browse Datasets</a>
            <?php if (session()->get('user_id')): ?>
                <a class="button gold" href="<?= site_url('upload') ?>">Upload Dataset</a>
            <?php else: ?>
                <a class="button gold" href="<?= site_url('login') ?>">Log In to Upload</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="content-section white">
    <div class="shell">
        <div class="section-intro">
            <h2 class="section-heading">Repository Features</h2>
            <p>A focused user-facing repository for finding useful datasets and managing contributor submissions without mixing in Admin Portal review screens.</p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <span class="feature-icon">DB</span>
                <h3>Published Dataset Catalog</h3>
                <p>Browse public Published datasets with searchable metadata, categories, data types, file formats, and upload dates.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon">SR</span>
                <h3>Fast Search and Filtering</h3>
                <p>Find datasets by title, description, tags, category, data type, file format, and date uploaded.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon">CT</span>
                <h3>Citation and BibTeX</h3>
                <p>Generate plain-text citations and BibTeX entries for repository datasets with contributor and year details.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon">UP</span>
                <h3>Contributor Uploads</h3>
                <p>Submit ZIP datasets with research, source, access, category, tags, and anonymization metadata.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon">MY</span>
                <h3>My Datasets</h3>
                <p>Track your own Pending Review, Revision Requested, Published, Rejected, or Archived dataset records.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon">RC</span>
                <h3>Recommendations</h3>
                <p>See similar Published datasets using simple metadata similarity across category, tags, type, format, and description.</p>
            </article>
        </div>
    </div>
</section>

<section class="content-section navy">
    <div class="shell stats-grid">
        <div>
            <span class="stat-number"><?= esc((string) ($publishedCount ?? 0)) ?></span>
            <span class="stat-label">Published datasets</span>
        </div>
        <div>
            <span class="stat-number">5</span>
            <span class="stat-label">Canonical data types</span>
        </div>
        <div>
            <span class="stat-number">4</span>
            <span class="stat-label">Access classifications</span>
        </div>
        <div>
            <span class="stat-number">ZIP</span>
            <span class="stat-label">Protected dataset uploads</span>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="shell split-grid">
        <article class="panel">
            <p class="tag">Recent Public Datasets</p>
            <?php if (empty($featuredDatasets)): ?>
                <h2>No Published datasets yet</h2>
                <p class="muted">Run migrations and seeders to load sample records, or log in and submit the first dataset for review.</p>
            <?php else: ?>
                <ul class="record-list">
                    <?php foreach ($featuredDatasets as $dataset): ?>
                        <li>
                            <strong><a href="<?= site_url('datasets/' . $dataset['id']) ?>"><?= esc($dataset['title']) ?></a></strong>
                            <span class="muted"><?= esc($dataset['category'] ?: 'Uncategorized') ?> &middot; <?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="actions">
                <a class="button" href="<?= site_url('datasets') ?>">Open Catalog</a>
            </div>
        </article>

        <article class="panel">
            <p class="tag">Lifecycle Boundary</p>
            <h2>Public site, not Admin Portal</h2>
            <p class="muted">This website creates submissions as Pending Review and displays status changes made elsewhere. Approval, rejection, reviewer queues, user management, audit-log viewers, backups, and reports are handled by the separate Admin Portal.</p>
        </article>
    </div>
</section>

<section class="content-section white">
    <div class="shell">
        <div class="section-intro">
            <h2 class="section-heading">Institutional Partners</h2>
            <p>Supporting research, innovation, and technology business incubation in the CSPC and ASOG TBI ecosystem.</p>
        </div>
        <div class="partner-row">
            <div class="partner-logo"><img src="<?= base_url('assets/img/dost-region5.png') ?>" alt="DOST Region 5"></div>
            <div class="partner-logo"><img src="<?= base_url('assets/img/pcieerd.png') ?>" alt="DOST PCIEERD"></div>
            <div class="partner-logo"><img src="<?= base_url('assets/img/cspc.png') ?>" alt="CSPC"></div>
            <div class="partner-logo"><img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI"></div>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="shell cta-band">
        <h2>Ready to explore ASOG TBI datasets?</h2>
        <p>Start with the Published catalog or log in to submit a new dataset package for review.</p>
        <div class="hero-actions">
            <a class="button" href="<?= site_url('datasets') ?>">Browse Datasets</a>
            <a class="button gold" href="<?= site_url(session()->get('user_id') ? 'upload' : 'login') ?>">Submit Dataset</a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
