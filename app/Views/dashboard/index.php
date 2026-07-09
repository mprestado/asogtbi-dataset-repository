<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="landing-hero">
    <div class="shell hero-content">
        <p class="eyebrow">ASOG TBI Dataset Repository</p>
        <h1>
            <span>Institutional</span>
            <em>Dataset Repository</em>
        </h1>
        <p>Discover and access datasets created, generated, and collected by student researchers from CSPC. Your gateway to academic excellence.</p>
        <form class="hero-search" action="<?= site_url('datasets') ?>" method="get">
            <label class="sr-only" for="home-search">Search dataset</label>
            <input id="home-search" name="q" type="search" placeholder="Search dataset">
            <button type="submit" aria-label="Search datasets"><span class="search-glyph" aria-hidden="true"></span></button>
        </form>
    </div>
</section>

<section class="landing-grid-section">
    <div class="shell">
        <section class="find-panel" aria-labelledby="find-heading">
            <p class="eyebrow">Repository Materials</p>
            <h2 id="find-heading">What you can find here</h2>
            <div class="find-grid">
                <article>
                    <span class="circle-icon"></span>
                    <h3>Text</h3>
                    <p>Reports, theses, abstracts, and labeled corpora.</p>
                </article>
                <article>
                    <span class="circle-icon"></span>
                    <h3>Audio</h3>
                    <p>Recorded interviews, signals, and annotated clips.</p>
                </article>
                <article>
                    <span class="circle-icon"></span>
                    <h3>Images</h3>
                    <p>Image collections for vision and inspection studies.</p>
                </article>
                <article>
                    <span class="circle-icon"></span>
                    <h3>Others</h3>
                    <p>Tabular, spatial, and mixed research datasets.</p>
                </article>
            </div>
        </section>

        <p class="landing-copy">Access a comprehensive collection of academic works, research outputs, and scholarly materials.</p>
    </div>
</section>

<section class="domains-section">
    <div class="shell">
        <p class="eyebrow">Research Domains</p>
        <h2>Domains</h2>
        <p>Explore the focus areas where institutional datasets can support research, prototyping, and evidence-based innovation.</p>
        <div class="domains-grid">
            <article>
                <span class="domain-orb"></span>
                <h3>Climate and Environment</h3>
            </article>
            <article>
                <span class="domain-orb"></span>
                <h3>Text & Natural Language Processing (NLP)</h3>
            </article>
            <article>
                <span class="domain-orb"></span>
                <h3>Geospatial & Spatial</h3>
            </article>
            <article>
                <span class="domain-orb"></span>
                <h3>Computer Vision (CV)</h3>
            </article>
        </div>
        <a class="see-more" href="<?= site_url('datasets') ?>">See more</a>
    </div>
</section>
<?= $this->endSection() ?>
