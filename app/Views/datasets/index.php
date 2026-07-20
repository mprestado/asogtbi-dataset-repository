<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel browse-hero-variant">
    <div class="shell">
        <p class="eyebrow">Dataset Discovery</p>
        <h1>Browse Datasets</h1>
        <p class="lead">Explore published datasets from CSPC and ASOG TBI research, capstone, analytics, AI/ML, and incubator projects.</p>
    </div>
</section>

<section class="catalog-toolbar">
    <div class="shell toolbar-inner">
        <form class="search-form-wrapper" method="get" action="<?= site_url('datasets') ?>">
            <label class="sr-only" for="q">Search datasets</label>
                <div class="search-input-group">
                    <div class="search-input-wrap">
                        <input class="search-field" id="q" name="q" value="<?= esc($search ?? '') ?>" placeholder="Search by title, tags, or category...">
                        <?php if (! empty($search)): ?>
                            <?php
                                $searchClearParams = array_filter([
                                    'data_type'     => $selectedDataType ?? '',
                                    'category'      => $selectedCategory ?? '',
                                    'file_format'   => $selectedFileFormat ?? '',
                                    'date_uploaded' => $selectedDateUploaded ?? '',
                                ], static fn($v) => $v !== '');
                                $searchClearUrl = site_url('datasets') . (! empty($searchClearParams) ? '?' . http_build_query($searchClearParams) : '');
                            ?>
                            <a class="search-clear-btn" href="<?= esc($searchClearUrl, 'attr') ?>" aria-label="Clear search">&times;</a>
                        <?php endif; ?>
                    </div>
                    <button class="button gold search-submit-btn" type="submit">
                        <span class="material-symbols-rounded" aria-hidden="true">search</span>
                        <span>Search</span>
                    </button>
                </div>
            <input type="hidden" name="data_type" value="<?= esc($selectedDataType ?? '') ?>">
            <input type="hidden" name="category" value="<?= esc($selectedCategory ?? '') ?>">
            <input type="hidden" name="file_format" value="<?= esc($selectedFileFormat ?? '') ?>">
            <input type="hidden" name="date_uploaded" value="<?= esc($selectedDateUploaded ?? '') ?>">
        </form>
    </div>
</section>

<section class="shell catalog-layout">
    <aside class="panel filter-panel">
        <div class="panel-head filter-sidebar-header">
            <div>
                <h2>Filters</h2>
            </div>
            <?php $resetFiltersUrl = site_url('datasets') . (! empty($search) ? '?q=' . urlencode($search) : ''); ?>
        </div>
        <form method="get" action="<?= site_url('datasets') ?>">
            <input type="hidden" name="q" value="<?= esc($search ?? '') ?>">

            <div class="filter-group">
                <label for="data_type">Data Type</label>
                <select id="data_type" name="data_type">
                    <option value="">All data types</option>
                    <?php foreach (['Text', 'Image', 'Audio', 'Video', 'Tabular'] as $dataType): ?>
                        <option value="<?= esc($dataType) ?>" <?= ($selectedDataType ?? '') === $dataType ? 'selected' : '' ?>>
                            <?= esc($dataType) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">All categories</option>
                    <?php foreach (($categories ?? []) as $category): ?>
                        <option value="<?= esc($category) ?>" <?= ($selectedCategory ?? '') === $category ? 'selected' : '' ?>>
                            <?= esc($category) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="file_format">File Format</label>
                <select id="file_format" name="file_format">
                    <option value="">All formats</option>
                    <?php foreach (($formats ?? []) as $format): ?>
                        <option value="<?= esc($format) ?>" <?= ($selectedFileFormat ?? '') === $format ? 'selected' : '' ?>>
                            <?= esc($format) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="date_uploaded">Date Uploaded</label>
                <select id="date_uploaded" name="date_uploaded">
                    <option value="">Any time</option>
                    <?php foreach (($dateOptions ?? []) as $value => $label): ?>
                        <option value="<?= esc($value) ?>" <?= ($selectedDateUploaded ?? '') === $value ? 'selected' : '' ?>>
                            <?= esc($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="actions">
                <button class="button filter-submit-btn" type="submit">Apply Filters</button>
            </div>
        </form>
    </aside>

    <section class="results-engine">
        <?php 
            $hasActiveFilters = !empty($selectedDataType) || !empty($selectedCategory) || !empty($selectedFileFormat) || !empty($selectedDateUploaded);
        ?>
        
        <div class="panel-head catalog-results-header">
            <div>
                <p class="tag">Repository Index</p>
                <?php
                    $summary = $paginationSummary ?? ['start' => 0, 'end' => 0, 'total' => $totalDatasets ?? 0];
                    $summaryText = (int) $summary['total'] > 0
                        ? 'Showing ' . (int) $summary['start'] . '-' . (int) $summary['end'] . ' of ' . (int) $summary['total'] . ' Datasets'
                        : '0 Datasets';
                ?>
                <h2><?= esc($summaryText) ?></h2>
            </div>
        </div>

        <?php if ($hasActiveFilters): ?>
            <?php
                $activeFilterValues = [
                    'data_type'     => $selectedDataType ?? '',
                    'category'      => $selectedCategory ?? '',
                    'file_format'   => $selectedFileFormat ?? '',
                    'date_uploaded' => $selectedDateUploaded ?? '',
                ];
                $activeFilterValues = array_filter($activeFilterValues, static fn($v) => $v !== '');

                $chipRemoveUrl = static function (string $key) use ($activeFilterValues, $search) {
                    $remaining = $activeFilterValues;
                    unset($remaining[$key]);
                    if (! empty($search)) {
                        $remaining = array_merge(['q' => $search], $remaining);
                    }
                    return site_url('datasets') . (! empty($remaining) ? '?' . http_build_query($remaining) : '');
                };

                $chipLabels = [
                    'data_type'     => 'Type',
                    'category'      => 'Category',
                    'file_format'   => 'Format',
                    'date_uploaded' => 'Uploaded',
                ];
            ?>
            <div class="active-chips-ribbon" aria-label="Active filters">
                <span class="ribbon-title">Active Filters:</span>
                <div class="chips-flex">
                    <?php foreach ($activeFilterValues as $key => $value): ?>
                        <span class="filter-chip-item">
                            <?= esc($chipLabels[$key]) ?>: <strong><?= esc($key === 'date_uploaded' ? ($dateOptions[$value] ?? $value) : $value) ?></strong>
                            <a class="chip-remove" href="<?= esc($chipRemoveUrl($key), 'attr') ?>" aria-label="Remove <?= esc($chipLabels[$key]) ?> filter">&times;</a>
                        </span>
                    <?php endforeach; ?>
                </div>
                <a class="clear-action-link chip-clear-all" href="<?= esc($resetFiltersUrl, 'attr') ?>">Reset Filters</a>
            </div>
        <?php endif; ?>

        <?php if (empty($datasets)): ?>
            <article class="panel catalog-empty-card">
                <div class="empty-vector">📂</div>
                <h2>No Datasets Found</h2>
                <p>We couldn't locate any items matching your active parameter selections. Try loosening your sidebar filters or modifying your query search terms.</p>
                <a class="button secondary" href="<?= site_url('datasets') ?>">Reset Search Filters</a>
            </article>
        <?php else: ?>
            <div class="catalog-dense-stack">
                <?php foreach ($datasets as $dataset): ?>
                    <?php
                        $previewTags = array_values(array_filter(array_map('trim', explode(',', (string) ($dataset['tags'] ?? '')))));
                        $previewTagText = $previewTags === [] ? 'No tags' : implode(', ', array_slice($previewTags, 0, 8));
                        if (count($previewTags) > 8) {
                            $previewTagText .= ', etc.';
                        }
                        $previewContributor = trim((string) ($dataset['author_name'] ?? 'Unknown contributor'));
                        if (! empty($dataset['author_email'])) {
                            $previewContributor .= ' - ' . (string) $dataset['author_email'];
                        }
                    ?>
                    <article class="compact-result-row">
                        <a class="dataset-row-cover" href="<?= site_url('datasets/' . $dataset['id']) ?>" aria-label="Open <?= esc($dataset['title'], 'attr') ?>">
                            <img src="<?= esc(dataset_cover_url($dataset), 'attr') ?>" alt="" loading="lazy">
                        </a>
                        <div class="row-main-details">
                            <div class="row-badge-line">
                                <span class="row-pill tech-type"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                <span class="row-pill tech-outline"><?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                                <span class="row-pill tech-format"><?= esc($dataset['file_format'] ?: 'ZIP') ?></span>
                            </div>
                            <h3 class="row-title">
                                <a href="<?= site_url('datasets/' . $dataset['id']) ?>"><?= esc($dataset['title']) ?></a>
                            </h3>
                            <p class="row-summary"><?= esc($dataset['description']) ?></p>
                            <div class="row-metadata-footer">
                                <span><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></span>
                                <?php if (! empty($dataset['created_at'])): ?>
                                    <span><?= esc(date('M d, Y', strtotime($dataset['created_at']))) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row-action-block">
                            <button class="button preview-trigger secondary compact-btn" type="button" data-preview-target="dataset-preview-<?= esc((string) $dataset['id']) ?>" aria-controls="dataset-preview-<?= esc((string) $dataset['id']) ?>" aria-expanded="false">
                                Preview
                            </button>
                            <a class="button gold compact-btn" href="<?= site_url('datasets/' . $dataset['id']) ?>">Explore</a>
                        </div>
                    </article>

                    <div class="preview-modal" id="dataset-preview-<?= esc((string) $dataset['id']) ?>" role="dialog" aria-modal="true" aria-labelledby="dataset-preview-title-<?= esc((string) $dataset['id']) ?>" aria-describedby="dataset-preview-summary-<?= esc((string) $dataset['id']) ?>" hidden>
                        <div class="preview-backdrop" data-preview-close></div>
                        <article class="preview-card dataset-preview-card" tabindex="-1">
                            <button class="preview-close" type="button" data-preview-close aria-label="Close preview">&times;</button>

                            <div class="preview-title-row">
                                <h2 id="dataset-preview-title-<?= esc((string) $dataset['id']) ?>" tabindex="-1" data-preview-initial><?= esc($dataset['title']) ?></h2>
                                <div class="row-badge-line preview-pill-line" aria-label="Dataset labels">
                                    <span class="row-pill tech-type"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                    <span class="row-pill tech-outline"><?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                                    <span class="row-pill tech-format"><?= esc($dataset['file_format'] ?: 'ZIP') ?></span>
                                </div>
                            </div>

                            <p class="preview-description" id="dataset-preview-summary-<?= esc((string) $dataset['id']) ?>"><?= esc($dataset['description']) ?></p>

                            <dl class="preview-fact-sheet">
                                <div>
                                    <dt>Contributor:</dt>
                                    <dd><?= esc($previewContributor) ?></dd>
                                </div>
                                <div>
                                    <dt>Research Title:</dt>
                                    <dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd>
                                </div>
                                <div>
                                    <dt>Authors:</dt>
                                    <dd><?= esc($dataset['members'] ?: 'Not listed') ?></dd>
                                </div>
                                <div>
                                    <dt>Date Uploaded:</dt>
                                    <dd><?= ! empty($dataset['created_at']) ? esc(date('F d, Y', strtotime($dataset['created_at']))) : 'Not recorded' ?></dd>
                                </div>
                                <div>
                                    <dt>Tags:</dt>
                                    <dd><?= esc($previewTagText) ?></dd>
                                </div>
                            </dl>

                            <!-- <div class="preview-actions">
                                <a class="button gold preview-explore-btn" href="<?= site_url('datasets/' . $dataset['id']) ?>" data-preview-primary>Explore</a>
                            </div> -->
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
            <?= $pager->links('default', 'catalog_full') ?>
        <?php endif; ?>
    </section>
</section>

<script>
    // Modal Interaction Core Scripts
    const focusablePreviewSelector = 'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';

    document.querySelectorAll('.preview-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const modal = document.getElementById(trigger.dataset.previewTarget);
            if (modal) {
                modal.hidden = false;
                document.body.classList.add('preview-open');
                trigger.setAttribute('aria-expanded', 'true');
                (modal.querySelector('[data-preview-initial]') || modal.querySelector('[data-preview-primary]') || modal.querySelector('.preview-card'))?.focus();
            }
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

    document.addEventListener('keydown', (event) => {
        const openModal = document.querySelector('.preview-modal:not([hidden])');
        if (!openModal) return;

        if (event.key === 'Escape') {
            closePreview(openModal);
            return;
        }

        if (event.key !== 'Tab') return;

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
    
    function syncStickyOffsets() {
        const toolbar = document.querySelector('.catalog-toolbar');
        if (!toolbar) return;
        document.documentElement.style.setProperty('--toolbar-h', `${toolbar.offsetHeight}px`);
    }
    document.addEventListener('DOMContentLoaded', syncStickyOffsets);
    window.addEventListener('load', syncStickyOffsets);
    window.addEventListener('resize', syncStickyOffsets);
</script>
<?= $this->endSection() ?>
