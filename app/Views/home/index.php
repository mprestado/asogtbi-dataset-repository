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

<section class="content-section navy feature-showcase-section">
    <div class="shell feature-showcase">
        <div class="feature-copy">
            <h2 class="section-heading"><span>Repository</span><span>Features</span></h2>
            <p>A centralized platform built to streamline data organization and accelerate your academic research workflow.</p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">database</span></span>
                <h3>Published Dataset Catalog</h3>
                <p>Browse public Published datasets with searchable metadata, categories, data types, disclosed contents, and upload dates.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">upload_file</span></span>
                <h3>Contributor Uploads</h3>
                <p>Submit ZIP datasets with research, source, access, category, tags, and anonymization metadata.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">search</span></span>
                <h3>Fast Search and Filtering</h3>
                <p>Find datasets by title, description, tags, category, data type, disclosed content formats, and date uploaded.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">folder_special</span></span>
                <h3>My Datasets</h3>
                <p>Track your own Pending Review, Revision Requested, Published, Rejected, or Archived dataset records.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">format_quote</span></span>
                <h3>Citation and BibTeX</h3>
                <p>Generate plain-text citations and BibTeX entries for repository datasets with contributor and year details.</p>
            </article>
            <article class="feature-card">
                <span class="feature-icon"><span class="material-symbols-rounded" aria-hidden="true">insights</span></span>
                <h3>Recommendations</h3>
                <p>See similar Published datasets using simple metadata similarity across category, tags, data type, disclosed formats, and description.</p>
            </article>
        </div>
    </div>
</section>

<section class="content-section home-insights-section">
    <div class="shell home-insights-grid">
        <div class="home-stat-grid" aria-label="Repository summary">
            <div class="stat-card">
                <span class="stat-icon"><span class="material-symbols-rounded" aria-hidden="true">database</span></span>
                <span class="stat-number"><?= esc((string) ($publishedCount ?? 0)) ?></span>
                <span class="stat-label">Published datasets</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><span class="material-symbols-rounded" aria-hidden="true">category</span></span>
                <span class="stat-number">5</span>
                <span class="stat-label">Canonical data types</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span></span>
                <span class="stat-number">4</span>
                <span class="stat-label">Access classifications</span>
            </div>
            <div class="stat-card">
                <span class="stat-icon"><span class="material-symbols-rounded" aria-hidden="true">folder_zip</span></span>
                <span class="stat-number">ZIP</span>
                <span class="stat-label">Secure upload format</span>
            </div>
        </div>

        <article class="panel home-recent-panel">
            <div class="home-recent-head">
                <p class="tag">Recent Public Datasets</p>
                <h2>Fresh from the catalog</h2>
            </div>
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
    </div>
</section>

<section class="content-section white">
    <div class="shell">
        <div class="section-intro">
            <h2 class="section-heading">Institutional Partners</h2>
            <p>Supporting research, innovation, and technology business incubation in the CSPC and ASOG TBI ecosystem.</p>
        </div>
        <div class="partner-row">
            <a class="partner-logo" href="https://region5.dost.gov.ph/" target="_blank" rel="noopener noreferrer" aria-label="Visit DOST Region 5">
                <img src="<?= base_url('assets/img/dost-region5.png') ?>" alt="DOST Region 5" loading="lazy">
            </a>
            <a class="partner-logo" href="https://www.sei.dost.gov.ph/" target="_blank" rel="noopener noreferrer" aria-label="Visit DOST SEI">
                <img src="<?= base_url('assets/img/pcieerd.png') ?>" alt="DOST SEI" loading="lazy">
            </a>
            <a class="partner-logo" href="https://cspc.edu.ph/" target="_blank" rel="noopener noreferrer" aria-label="Visit CSPC">
                <img src="<?= base_url('assets/img/cspc.png') ?>" alt="CSPC" loading="lazy">
            </a>
            <a class="partner-logo" href="https://asogtbi.com/" target="_blank" rel="noopener noreferrer" aria-label="Visit ASOG TBI">
                <img src="<?= base_url('assets/img/ASOG-TBI-stacked-v2.png') ?>" alt="ASOG TBI" loading="lazy">
            </a>
            <a class="partner-logo partner-logo--ccs" href="https://ccs.cspc.edu.ph/" target="_blank" rel="noopener noreferrer" aria-label="Visit CSPC College of Computer Studies">
                <img src="<?= base_url('assets/img/ccs-landscape-w-text.png') ?>" alt="CSPC College of Computer Studies" loading="lazy">
            </a>
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
