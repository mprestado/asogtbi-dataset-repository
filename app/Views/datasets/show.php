<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
    $citationDataset = [
        'title' => $dataset['title'],
        'author' => $dataset['author_name'] ?? '',
        'year' => ! empty($dataset['created_at']) ? date('Y', strtotime($dataset['created_at'])) : date('Y'),
    ];
    $plainTextCitation = dataset_citation($citationDataset);
    $bibtexCitation = dataset_bibtex($citationDataset);

    $description = trim((string) ($dataset['description'] ?? ''));
    $descriptionLength = strlen($description);
    $hasExpandableDescription = $descriptionLength > 180;
    $publishedSource = $dataset['approved_at'] ?? $dataset['created_at'] ?? null;
    $publishedDate = ! empty($publishedSource) ? date('m/d/Y', strtotime((string) $publishedSource)) : date('m/d/Y');
    $tagItems = array_values(array_filter(array_map('trim', explode(',', (string) ($dataset['tags'] ?? '')))));

    $recommendationPreviewData = [];
    foreach ($recommendations as $recommended) {
        $recommendationPreviewData[] = [
            'id' => (int) $recommended['id'],
            'title' => (string) ($recommended['title'] ?? 'Dataset'),
            'description' => trim((string) ($recommended['description'] ?? '')),
            'category' => trim((string) ($recommended['category'] ?? 'Uncategorized')) ?: 'Uncategorized',
            'data_type' => trim((string) ($recommended['data_type'] ?? 'Dataset')) ?: 'Dataset',
            'file_format' => trim((string) ($recommended['file_format'] ?? 'ZIP')) ?: 'ZIP',
            'author_name' => trim((string) ($recommended['author_name'] ?? 'Unknown contributor')) ?: 'Unknown contributor',
            'research_title' => trim((string) ($recommended['research_title'] ?? '')) ?: 'Not set',
            'members' => trim((string) ($recommended['members'] ?? '')) ?: 'Not listed',
            'created_at' => ! empty($recommended['created_at']) ? date('F d, Y', strtotime((string) $recommended['created_at'])) : 'Not recorded',
            'score' => (int) ($recommended['score'] ?? 0),
            'tags' => array_values(array_filter(array_map('trim', explode(',', (string) ($recommended['tags'] ?? ''))))),
        ];
    }
?>

<section class="shell dataset-detail-shell">
    <div class="dataset-detail-main">
        <article class="panel dataset-hero-card <?= $hasExpandableDescription ? 'is-collapsed' : 'is-static' ?>">
            <div class="dataset-hero-cover">
                <div class="dataset-hero-cover-top">
                    <div class="dataset-hero-badges">
                        <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>"><?= esc($statusLabel ?? 'Unknown') ?></span>
                        <span class="access-pill access-<?= esc($dataset['access_type'] ?? 'public') ?>"><?= esc($accessLabel ?? 'Public') ?></span>
                    </div>
                    <span class="dataset-hero-version">v<?= esc($dataset['version'] ?? '1.0') ?></span>
                </div>

                <div class="dataset-hero-copy">
                    <h1><?= esc($dataset['title']) ?></h1>
                    <p class="dataset-hero-date">Published on: <?= esc($publishedDate) ?></p>
                </div>
            </div>

            <div class="dataset-hero-body">
                <div class="dataset-hero-summary" data-description-wrap>
                    <p class="dataset-hero-description" data-description-copy><?= esc($description ?: 'No description provided yet.') ?></p>
                </div>

                <?php if ($hasExpandableDescription): ?>
                    <button
                        class="dataset-hero-toggle"
                        type="button"
                        data-description-toggle
                        aria-expanded="false"
                    >
                        <span data-description-label>Read more</span>
                        <span class="material-symbols-rounded" aria-hidden="true">expand_more</span>
                    </button>
                <?php endif; ?>
            </div>
        </article>

        <details class="panel dataset-accordion" open>
            <summary class="dataset-accordion-summary">
                <span>
                    <small>Dataset Information</small>
                    <strong>Metadata, source, and tag chips</strong>
                </span>
                <span class="dataset-accordion-icon material-symbols-rounded" aria-hidden="true">expand_more</span>
            </summary>
            <div class="dataset-accordion-body">
                <dl class="dataset-info-grid" aria-label="Dataset metadata">
                    <div>
                        <dt>Research Title</dt>
                        <dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd>
                    </div>
                    <div>
                        <dt>Project Head</dt>
                        <dd><?= esc($dataset['project_head'] ?: 'Not set') ?></dd>
                    </div>
                    <div>
                        <dt>Authors</dt>
                        <dd><?= esc($dataset['members'] ?: 'Not listed') ?></dd>
                    </div>
                    <div>
                        <dt>Source</dt>
                        <dd>
                            <?= esc($dataset['source_type'] ?: 'Not set') ?>
                            <?php if (! empty($dataset['source_link'])): ?>
                                <span class="dataset-inline-separator">&middot;</span>
                                <a href="<?= esc((string) $dataset['source_link'], 'attr') ?>" target="_blank" rel="noopener noreferrer"><?= esc($dataset['source_link']) ?></a>
                            <?php endif; ?>
                        </dd>
                    </div>
                    <div>
                        <dt>Category</dt>
                        <dd><?= esc($dataset['category'] ?: 'Uncategorized') ?></dd>
                    </div>
                    <div>
                        <dt>Data Type</dt>
                        <dd><?= esc($dataset['data_type'] ?: 'Dataset') ?></dd>
                    </div>
                    <div>
                        <dt>Access</dt>
                        <dd><?= esc($accessLabel ?? 'Public') ?></dd>
                    </div>
                    <div>
                        <dt>Status</dt>
                        <dd><?= esc($statusLabel ?? 'Unknown') ?></dd>
                    </div>
                </dl>

                <div class="dataset-chip-block">
                    <p class="dataset-chip-label">Tags</p>
                    <?php if (empty($tagItems)): ?>
                        <p class="muted">No tags</p>
                    <?php else: ?>
                        <div class="dataset-chip-list" aria-label="Dataset tags">
                            <?php foreach ($tagItems as $tag): ?>
                                <span class="dataset-chip"><?= esc($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </details>

        <details class="panel dataset-accordion" open>
            <summary class="dataset-accordion-summary">
                <span>
                    <small>Dataset Files</small>
                    <strong>Latest upload and download access</strong>
                </span>
                <span class="dataset-accordion-icon material-symbols-rounded" aria-hidden="true">expand_more</span>
            </summary>
            <div class="dataset-accordion-body">
                <div class="dataset-files-head" aria-hidden="true">
                    <span>Files</span>
                    <span>Size</span>
                </div>

                <?php if (! empty($latestFile)): ?>
                    <article class="dataset-file-row">
                        <div class="dataset-file-copy">
                            <span class="dataset-file-name"><?= esc($latestFile['original_name']) ?></span>
                            <p class="dataset-file-note"><?= esc(number_format((int) $latestFile['file_size'])) ?> bytes</p>
                        </div>
                        <div class="dataset-file-size"><?= esc(number_format((int) $latestFile['file_size'])) ?> bytes</div>
                    </article>
                <?php else: ?>
                    <p class="muted">No uploaded dataset file is available for this record yet.</p>
                <?php endif; ?>
            </div>
        </details>

        <details class="panel dataset-accordion dataset-recommendations-accordion" open>
            <summary class="dataset-accordion-summary">
                <span>
                    <small>Recommended Datasets</small>
                    <strong>Similar datasets and preview shortcuts</strong>
                </span>
                <span class="dataset-accordion-icon material-symbols-rounded" aria-hidden="true">expand_more</span>
            </summary>
            <div class="dataset-accordion-body">
                <?php if (empty($recommendationPreviewData)): ?>
                    <p class="muted">No metadata-based recommendations are available yet.</p>
                <?php else: ?>
                    <div class="dataset-rec-list">
                        <?php foreach ($recommendationPreviewData as $recommended): ?>
                            <article class="dataset-rec-row">
                                <div class="dataset-rec-copy">
                                    <h3>
                                        <a href="<?= site_url('datasets/' . $recommended['id']) ?>"><?= esc($recommended['title']) ?></a>
                                    </h3>
                                    <div class="dataset-rec-meta">
                                        <span class="dataset-chip dataset-chip--accent"><?= esc($recommended['category']) ?></span>
                                        <span class="dataset-rec-score">score <?= esc((string) $recommended['score']) ?></span>
                                    </div>
                                </div>
                                <button
                                    class="button secondary dataset-preview-trigger"
                                    type="button"
                                    data-preview-target="dataset-preview-<?= esc((string) $recommended['id']) ?>"
                                    aria-controls="dataset-preview-<?= esc((string) $recommended['id']) ?>"
                                    aria-expanded="false"
                                >
                                    Preview
                                </button>
                            </article>

                            <div class="preview-modal" id="dataset-preview-<?= esc((string) $recommended['id']) ?>" role="dialog" aria-modal="true" aria-labelledby="dataset-preview-title-<?= esc((string) $recommended['id']) ?>" aria-describedby="dataset-preview-summary-<?= esc((string) $recommended['id']) ?>" hidden>
                                <div class="preview-backdrop" data-preview-close></div>
                                <article class="preview-card dataset-preview-card" tabindex="-1">
                                    <button class="preview-close" type="button" data-preview-close aria-label="Close preview">&times;</button>

                                    <div class="preview-title-row">
                                        <div>
                                            <p class="tag">Recommendation Preview</p>
                                            <h2 id="dataset-preview-title-<?= esc((string) $recommended['id']) ?>" tabindex="-1" data-preview-initial><?= esc($recommended['title']) ?></h2>
                                        </div>
                                        <div class="row-badge-line preview-pill-line" aria-label="Dataset labels">
                                            <span class="row-pill tech-type"><?= esc($recommended['data_type']) ?></span>
                                            <span class="row-pill tech-outline"><?= esc($recommended['category']) ?></span>
                                            <span class="row-pill tech-format"><?= esc($recommended['file_format']) ?></span>
                                        </div>
                                    </div>

                                    <p class="preview-description" id="dataset-preview-summary-<?= esc((string) $recommended['id']) ?>"><?= esc($recommended['description'] ?: 'No description provided yet.') ?></p>

                                    <dl class="preview-fact-sheet">
                                        <div>
                                            <dt>Contributor:</dt>
                                            <dd><?= esc($recommended['author_name']) ?></dd>
                                        </div>
                                        <div>
                                            <dt>Research Title:</dt>
                                            <dd><?= esc($recommended['research_title']) ?></dd>
                                        </div>
                                        <div>
                                            <dt>Authors:</dt>
                                            <dd><?= esc($recommended['members']) ?></dd>
                                        </div>
                                        <div>
                                            <dt>Date Uploaded:</dt>
                                            <dd><?= esc($recommended['created_at']) ?></dd>
                                        </div>
                                        <div>
                                            <dt>Tags:</dt>
                                            <dd><?= esc($recommended['tags'] === [] ? 'No tags' : implode(', ', array_slice($recommended['tags'], 0, 8))) ?></dd>
                                        </div>
                                    </dl>

                                    <div class="preview-actions">
                                        <a class="button gold preview-explore-btn" href="<?= site_url('datasets/' . $recommended['id']) ?>" data-preview-primary>Explore</a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </details>
    </div>

    <aside class="panel dataset-sidebar">
        <p class="tag">Dataset File</p>
        <h2>Download and Cite</h2>

        <dl class="dataset-stats-grid" aria-label="Dataset summary statistics">
            <div>
                <dt>Version</dt>
                <dd><?= esc($dataset['version'] ?? '1.0') ?></dd>
            </div>
            <div>
                <dt>Views</dt>
                <dd><?= esc((string) ($viewCount ?? 0)) ?></dd>
            </div>
            <div>
                <dt>Downloads</dt>
                <dd><?= esc((string) ($downloadCount ?? 0)) ?></dd>
            </div>
            <div>
                <dt>Contributor</dt>
                <dd><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></dd>
            </div>
        </dl>

        <div class="actions dataset-sidebar-actions">
            <?php if (! empty($latestFile)): ?>
                <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download</a>
            <?php else: ?>
                <span class="button is-disabled" aria-disabled="true">Download unavailable</span>
            <?php endif; ?>
            <button
                class="button gold citation-trigger"
                type="button"
                data-citation-target="dataset-citation-<?= esc((string) $datasetId) ?>"
                aria-controls="dataset-citation-<?= esc((string) $datasetId) ?>"
                aria-expanded="false"
            >
                Cite
            </button>
            <?php if (! empty($canEdit)): ?>
                <a class="button secondary dataset-sidebar-edit" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit dataset</a>
            <?php endif; ?>
        </div>
    </aside>
</section>

<div class="preview-modal citation-modal" id="dataset-citation-<?= esc((string) $datasetId) ?>" role="dialog" aria-modal="true" aria-labelledby="citation-modal-title-<?= esc((string) $datasetId) ?>" hidden>
    <div class="preview-backdrop" data-citation-close></div>
    <article class="preview-card citation-card" tabindex="-1">
        <button class="preview-close" type="button" data-citation-close aria-label="Close citations">&times;</button>
        <p class="tag">Citation</p>
        <h2 id="citation-modal-title-<?= esc((string) $datasetId) ?>">Cite this dataset</h2>

        <section class="citation-format" aria-labelledby="plain-text-citation-title">
            <div class="citation-format-head">
                <h3 id="plain-text-citation-title">Plain text</h3>
                <button class="button copy-citation" type="button" data-copy-citation="plain-text-citation-<?= esc((string) $datasetId) ?>">Copy Citation</button>
            </div>
            <pre id="plain-text-citation-<?= esc((string) $datasetId) ?>" class="citation-output"><?= esc($plainTextCitation) ?></pre>
        </section>

        <section class="citation-format" aria-labelledby="bibtex-citation-title">
            <div class="citation-format-head">
                <h3 id="bibtex-citation-title">BibTeX</h3>
                <button class="button copy-citation" type="button" data-copy-citation="bibtex-citation-<?= esc((string) $datasetId) ?>">Copy BibTeX</button>
            </div>
            <pre id="bibtex-citation-<?= esc((string) $datasetId) ?>" class="citation-output citation-output--bibtex"><?= esc($bibtexCitation) ?></pre>
        </section>
    </article>
</div>

<script>
    const descriptionToggle = document.querySelector('[data-description-toggle]');
    const descriptionCard = document.querySelector('.dataset-hero-card');
    const descriptionLabel = document.querySelector('[data-description-label]');

    descriptionToggle?.addEventListener('click', () => {
        const isExpanded = descriptionToggle.getAttribute('aria-expanded') === 'true';
        const nextExpanded = ! isExpanded;

        descriptionToggle.setAttribute('aria-expanded', nextExpanded ? 'true' : 'false');
        descriptionCard?.classList.toggle('is-expanded', nextExpanded);
        descriptionCard?.classList.toggle('is-collapsed', ! nextExpanded);

        if (descriptionLabel) {
            descriptionLabel.textContent = nextExpanded ? 'Show less' : 'Read more';
        }
    });

    const focusablePreviewSelector = 'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';

    document.querySelectorAll('.dataset-preview-trigger, .preview-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const modal = document.getElementById(trigger.dataset.previewTarget);
            if (!modal) return;

            modal.hidden = false;
            document.body.classList.add('preview-open');
            trigger.setAttribute('aria-expanded', 'true');
            (modal.querySelector('[data-preview-initial]') || modal.querySelector('[data-preview-primary]') || modal.querySelector('.preview-card'))?.focus();
        });
    });

    const closePreview = (modal) => {
        if (!modal) return;
        const trigger = document.querySelector(`[data-preview-target="${modal.id}"]`);
        modal.hidden = true;
        document.body.classList.remove('preview-open');
        trigger?.setAttribute('aria-expanded', 'false');
        trigger?.focus();
    };

    document.querySelectorAll('[data-preview-close]').forEach((control) => {
        control.addEventListener('click', () => closePreview(control.closest('.preview-modal')));
    });

    document.querySelectorAll('.citation-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const modal = document.getElementById(trigger.dataset.citationTarget);
            if (!modal) return;

            modal.hidden = false;
            document.body.classList.add('preview-open');
            trigger.setAttribute('aria-expanded', 'true');
            modal.querySelector('.citation-card')?.focus();
        });
    });

    const closeCitation = (modal) => {
        if (!modal) return;

        const trigger = document.querySelector(`[data-citation-target="${modal.id}"]`);
        modal.hidden = true;
        document.body.classList.remove('preview-open');
        trigger?.setAttribute('aria-expanded', 'false');
        trigger?.focus();
    };

    document.querySelectorAll('[data-citation-close]').forEach((control) => {
        control.addEventListener('click', () => closeCitation(control.closest('.citation-modal')));
    });

    document.querySelectorAll('[data-copy-citation]').forEach((button) => {
        button.addEventListener('click', async () => {
            const citation = document.getElementById(button.dataset.copyCitation)?.textContent;
            if (!citation) return;

            const originalLabel = button.textContent;
            try {
                await navigator.clipboard.writeText(citation.trim());
                button.textContent = 'Copied';
            } catch (error) {
                button.textContent = 'Copy failed';
            }

            window.setTimeout(() => { button.textContent = originalLabel; }, 1600);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            const openPreviewModal = document.querySelector('.preview-modal:not(.citation-modal):not([hidden])');
            if (openPreviewModal) {
                closePreview(openPreviewModal);
                return;
            }

            const openCitationModal = document.querySelector('.citation-modal:not([hidden])');
            if (openCitationModal) {
                closeCitation(openCitationModal);
            }

            return;
        }

        if (event.key !== 'Tab') return;

        const openModal = document.querySelector('.preview-modal:not(.citation-modal):not([hidden])');
        if (!openModal) return;

        const focusable = Array.from(openModal.querySelectorAll(focusablePreviewSelector))
            .filter((element) => element.offsetParent !== null || element === document.activeElement);
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });
</script>
<?= $this->endSection() ?>
