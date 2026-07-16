<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="landing-hero">
    <div class="shell hero-content">
        <p class="collab">CSPC <span class="star-gold">✦</span> ASOG TBI</p>
        <h1>Institutional</h1>
        <h1 class="sub"><em>Dataset Repository</em></h1>
        <p>Discover, cite, download, and contribute institutional datasets for thesis, capstone, research, AI/ML, analytics, and startup development.</p>

        <form class="hero-search" method="get" action="<?= site_url('datasets') ?>">
            <label class="sr-only" for="home-search">Search datasets</label>
            <input type="search" id="home-search" name="q" placeholder="Search dataset">
            <button type="submit" aria-label="Search">
                <span class="material-symbols-rounded" aria-hidden="true">search</span>
            </button>
        </form>
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
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">database</span></span>
                <h3>Published Dataset Catalog</h3>
                <p>Browse public Published datasets with searchable metadata, categories, data types, file formats, and upload dates.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">search</span></span>
                <h3>Fast Search and Filtering</h3>
                <p>Find datasets by title, description, tags, category, data type, file format, and date uploaded.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">format_quote</span></span>
                <h3>Citation and BibTeX</h3>
                <p>Generate plain-text citations and BibTeX entries for repository datasets with contributor and year details.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">upload_file</span></span>
                <h3>Contributor Uploads</h3>
                <p>Submit ZIP datasets with research, source, access, category, tags, and anonymization metadata.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">folder_special</span></span>
                <h3>My Datasets</h3>
                <p>Track your own Pending Review, Revision Requested, Published, Rejected, or Archived dataset records.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">insights</span></span>
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
                <div class="home-recent-stack">
                    <?php foreach ($featuredDatasets as $dataset): ?>
                        <a class="home-recent-row" href="<?= site_url('datasets/' . $dataset['id']) ?>">
                            <div class="row-badge-line">
                                <span class="row-pill tech-type"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                <span class="row-pill tech-outline"><?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                            </div>
                            <strong class="home-recent-title"><?= esc($dataset['title']) ?></strong>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="actions">
                <a class="button" href="<?= site_url('datasets') ?>">Open Catalog</a>
            </div>
        </article>

        <article class="panel">
            <p class="tag">Lifecycle Boundary</p>
            <h2>Public site, not Admin Portal</h2>
            <p class="muted">Submissions move through assigned Research Ethics and Technical verification before a repository administrator can publish them. Every moderation decision is retained in the audit trail.</p>
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
            <div class="partner-logo" loading="lazy"><img src="<?= base_url('assets/img/dost-region5.png') ?>" alt="DOST Region 5"></div>
            <div class="partner-logo" loading="lazy"><img src="<?= base_url('assets/img/pcieerd.png') ?>" alt="DOST PCIEERD"></div>
            <div class="partner-logo" loading="lazy"><img src="<?= base_url('assets/img/cspc.png') ?>" alt="CSPC"></div>
            <div class="partner-logo" loading="lazy"><img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI"></div>
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
