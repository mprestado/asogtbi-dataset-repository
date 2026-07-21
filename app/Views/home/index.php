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
        
        <!-- 1. THE FLOATING CARD (Overlaps the Hero) -->
        <div class="floating-feature-card">
            <div class="floating-feature-grid">
                <div class="floating-feature-item">
                    <span class="floating-feature-icon"><span class="material-symbols-rounded" aria-hidden="true">school</span></span>
                    <h3>Academic Origins</h3>
                    <p>Sourced from completed research, theses, and capstone projects.</p>
                </div>
                <div class="floating-feature-item">
                    <span class="floating-feature-icon"><span class="material-symbols-rounded" aria-hidden="true">fact_check</span></span>
                    <h3>Fully Documented</h3>
                    <p>Backed by complete metadata and expert validation certificates.</p>
                </div>
                <div class="floating-feature-item">
                    <span class="floating-feature-icon"><span class="material-symbols-rounded" aria-hidden="true">verified_user</span></span>
                    <h3>Ethically Reviewed</h3>
                    <p>Cleared by the Research Ethics Board and ASOG TBI before upload.</p>
                </div>
            </div>
        </div>

        <!-- 2. THE NEW MAIN HEADER -->
        <div class="second-page-header">
            <h2>A foundation of research integrity</h2>
            <p>Every dataset in our repository undergoes a strict multi-stage review process to ensure privacy, quality, and academic validity.</p>
        </div>

        <!-- 3. HARMONIZED DASHBOARD (Stats & Features) -->
        <div class="repo-overview-grid">
            
            <!-- Left Side: Stats -->
            <div class="repo-overview-copy">
                <h3 class="dashboard-subtitle">Platform Snapshot</h3>
                <div class="repo-stat-stack">
                    <div class="repo-stat-row">
                        <span class="repo-stat-number"><?= esc((string) ($publishedCount ?? 0)) ?></span>
                        <span class="repo-stat-label">Published datasets</span>
                    </div>
                    <div class="repo-stat-row">
                        <span class="repo-stat-number">5</span>
                        <span class="repo-stat-label">Canonical data types</span>
                    </div>
                    <div class="repo-stat-row">
                        <span class="repo-stat-number">ZIP</span>
                        <span class="repo-stat-label">Protected dataset uploads</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Carousel -->
            <div class="repo-carousel-wrap">
                <div class="repo-carousel-head">
                    <h3 class="dashboard-subtitle">Core Features</h3>
                    <div class="repo-carousel-nav">
                        <button type="button" class="repo-carousel-btn" data-carousel-prev aria-label="Previous feature">‹</button>
                        <button type="button" class="repo-carousel-btn" data-carousel-next aria-label="Next feature">›</button>
                    </div>
                </div>
                <div class="repo-carousel-track" id="repo-carousel-track">
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">01</span>
                        <h3>Published Dataset Catalog</h3>
                        <p>Browse public Published datasets with searchable metadata, categories, data types, file formats, and upload dates.</p>
                    </article>
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">02</span>
                        <h3>Contributor Uploads</h3>
                        <p>Submit ZIP datasets with research, source, access, category, tags, and anonymization metadata.</p>
                    </article>
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">03</span>
                        <h3>Fast Search and Filtering</h3>
                        <p>Find datasets by title, description, tags, category, data type, file format, and date uploaded.</p>
                    </article>
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">04</span>
                        <h3>My Datasets</h3>
                        <p>Track your own Pending Review, Revision Requested, Published, Rejected, or Archived dataset records.</p>
                    </article>
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">05</span>
                        <h3>Citation and BibTeX</h3>
                        <p>Generate plain-text citations and BibTeX entries automatically for repository datasets.</p>
                    </article>
                    <article class="repo-carousel-card">
                        <span class="repo-card-index">06</span>
                        <h3>Recommendations</h3>
                        <p>See similar Published datasets using simple metadata similarity across category, tags, data type, disclosed formats, and description.</p>
                    </article>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="content-section home-insights-section">
    <div class="shell">
        <div class="home-dataset-head">
            <p class="dashboard-subtitle">Public Dataset Activity</p>
            <h2>Explore what is new and what researchers revisit most.</h2>
            <p>Recent releases and view-ranked records share one clean space, keeping the home screen focused on catalog discovery.</p>
        </div>

        <div class="home-dataset-grid">
            <article class="home-dataset-panel">
                <div class="home-list-head">
                    <div>
                        <p>Recent Public Datasets</p>
                        <h3>Fresh from the catalog</h3>
                    </div>
                </div>
                <?php if (empty($featuredDatasets)): ?>
                    <div class="home-empty-line">
                        <strong>No published datasets yet</strong>
                        <p>Run migrations and seeders, or submit the first public dataset for review.</p>
                    </div>
                <?php else: ?>
                    <div class="home-dataset-list">
                        <?php foreach ($featuredDatasets as $dataset): ?>
                            <a class="home-dataset-row" href="<?= site_url('datasets/' . $dataset['id']) ?>">
                                <span class="home-row-kicker"><?= esc($dataset['data_type'] ?: 'Dataset') ?> / <?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                                <strong><?= esc($dataset['title']) ?></strong>
                                <small><?= esc($dataset['author_name'] ?? 'Repository contributor') ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </article>

            <article class="home-dataset-panel">
                <div class="home-list-head">
                    <div>
                        <p>Popular Datasets</p>
                        <h3>Most viewed records</h3>
                    </div>
                </div>
                <?php if (empty($popularDatasets)): ?>
                    <div class="home-empty-line">
                        <strong>No view activity yet</strong>
                        <p>Dataset views will appear here once public records are opened.</p>
                    </div>
                <?php else: ?>
                    <div class="home-dataset-list">
                        <?php foreach ($popularDatasets as $dataset): ?>
                            <a class="home-dataset-row" href="<?= site_url('datasets/' . $dataset['id']) ?>">
                                <span class="home-row-kicker"><?= esc((string) ((int) ($dataset['view_count'] ?? 0))) ?> <?= ((int) ($dataset['view_count'] ?? 0)) === 1 ? 'view' : 'views' ?> / <?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                <strong><?= esc($dataset['title']) ?></strong>
                                <small><?= esc($dataset['category'] ?: 'Uncategorized') ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </article>
        </div>

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

<!-- Carousel Navigation Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('repo-carousel-track');
    const prevBtn = document.querySelector('[data-carousel-prev]');
    const nextBtn = document.querySelector('[data-carousel-next]');

    if (!track || !prevBtn || !nextBtn) return;

    const scrollAmount = 300; 

    prevBtn.addEventListener('click', () => {
        track.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    nextBtn.addEventListener('click', () => {
        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
});
</script>

<?= $this->endSection() ?>
