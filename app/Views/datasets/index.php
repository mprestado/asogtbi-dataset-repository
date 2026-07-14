<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Dataset Discovery</p>
        <h1>Browse Datasets</h1>
        <p class="lead">Explore Published datasets from CSPC and ASOG TBI research, capstone, analytics, AI/ML, and incubator projects.</p>
    </div>
</section>

<section class="catalog-toolbar">
    <div class="shell toolbar-inner">
        <form method="get" action="<?= site_url('datasets') ?>">
            <label class="sr-only" for="q">Search datasets</label>
            <input class="search-field" id="q" name="q" value="<?= esc($search ?? '') ?>" placeholder="Search by title, description, tags, or category">
            <input type="hidden" name="data_type" value="<?= esc($selectedDataType ?? '') ?>">
            <input type="hidden" name="category" value="<?= esc($selectedCategory ?? '') ?>">
            <input type="hidden" name="file_format" value="<?= esc($selectedFileFormat ?? '') ?>">
            <input type="hidden" name="date_uploaded" value="<?= esc($selectedDateUploaded ?? '') ?>">
        </form>
        <div class="filter-row">
            <a class="button secondary" href="<?= site_url('datasets') ?>">Clear Filters</a>
            <?php if (session()->get('user_id')): ?>
                <a class="button gold" href="<?= site_url('upload') ?>">Upload Dataset</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="shell split-grid catalog-layout">
    <aside class="panel filter-panel">
        <div class="panel-head">
            <div>
                <p class="tag">Filters</p>
                <h2>Refine results</h2>
            </div>
        </div>
        <form method="get" action="<?= site_url('datasets') ?>">
            <input type="hidden" name="q" value="<?= esc($search ?? '') ?>">

            <label for="data_type">Data Type</label>
            <select id="data_type" name="data_type">
                <option value="">All data types</option>
                <?php foreach (['Text', 'Image', 'Audio', 'Video', 'Tabular'] as $dataType): ?>
                    <option value="<?= esc($dataType) ?>" <?= ($selectedDataType ?? '') === $dataType ? 'selected' : '' ?>>
                        <?= esc($dataType) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="">All categories</option>
                <?php foreach (($categories ?? []) as $category): ?>
                    <option value="<?= esc($category) ?>" <?= ($selectedCategory ?? '') === $category ? 'selected' : '' ?>>
                        <?= esc($category) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="file_format">File Format</label>
            <select id="file_format" name="file_format">
                <option value="">All formats</option>
                <?php foreach (($formats ?? []) as $format): ?>
                    <option value="<?= esc($format) ?>" <?= ($selectedFileFormat ?? '') === $format ? 'selected' : '' ?>>
                        <?= esc($format) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="date_uploaded">Date Uploaded</label>
            <select id="date_uploaded" name="date_uploaded">
                <option value="">Any time</option>
                <?php foreach (($dateOptions ?? []) as $value => $label): ?>
                    <option value="<?= esc($value) ?>" <?= ($selectedDateUploaded ?? '') === $value ? 'selected' : '' ?>>
                        <?= esc($label) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="actions">
                <button class="button" type="submit">Apply Filters</button>
            </div>
        </form>
    </aside>

    <section>
        <div class="panel-head">
            <div>
                <p class="tag">Results</p>
                <h2><?= esc((string) count($datasets ?? [])) ?> datasets on this page</h2>
            </div>
            <?php if (! empty($search)): ?>
                <span class="badge outline">Search: <?= esc($search) ?></span>
            <?php endif; ?>
        </div>

        <?php if (empty($datasets)): ?>
            <article class="panel">
                <h2>No datasets found</h2>
                <p class="muted">Try adjusting your search or filters. Public browse only shows Published datasets you are allowed to access.</p>
            </article>
        <?php else: ?>
            <div class="result-list">
                <?php foreach ($datasets as $dataset): ?>
                    <article class="result-card">
                        <div class="result-head">
                            <div>
                                <div class="badge-row">
                                    <span class="badge"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                    <span class="badge outline"><?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                                    <span class="badge outline"><?= esc(($accessOptions[$dataset['access_type'] ?? ''] ?? 'Public')) ?></span>
                                </div>
                                <h3><a href="<?= site_url('datasets/' . $dataset['id']) ?>"><?= esc($dataset['title']) ?></a></h3>
                                <div class="meta-row">
                                    <span><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></span>
                                    <span><?= esc($dataset['file_format'] ?: 'ZIP') ?></span>
                                    <?php if (! empty($dataset['created_at'])): ?>
                                        <span><?= esc(date('M d, Y', strtotime($dataset['created_at']))) ?></span>
                                    <?php endif; ?>
                                </div>
                                <p><?= esc($dataset['description']) ?></p>
                            </div>
                            <div class="result-actions">
                                <button
                                    class="button preview-trigger"
                                    type="button"
                                    data-preview-target="dataset-preview-<?= esc((string) $dataset['id']) ?>"
                                    aria-controls="dataset-preview-<?= esc((string) $dataset['id']) ?>"
                                    aria-expanded="false"
                                >
                                    Preview
                                </button>
                                <a class="button secondary" href="<?= site_url('datasets/' . $dataset['id']) ?>" title="Open the dataset page before downloading">Details &amp; Download</a>
                            </div>
                        </div>
                    </article>

                    <div class="preview-modal" id="dataset-preview-<?= esc((string) $dataset['id']) ?>" role="dialog" aria-modal="true" aria-labelledby="dataset-preview-title-<?= esc((string) $dataset['id']) ?>" aria-describedby="dataset-preview-summary-<?= esc((string) $dataset['id']) ?>" hidden>
                        <div class="preview-backdrop" data-preview-close></div>
                        <article class="preview-card dataset-preview-card" tabindex="-1">
                            <button class="preview-close" type="button" data-preview-close aria-label="Close preview">&times;</button>
                            <div class="badge-row">
                                <span class="badge"><?= esc($dataset['data_type'] ?: 'Dataset') ?></span>
                                <span class="badge outline"><?= esc($dataset['category'] ?: 'Uncategorized') ?></span>
                                <span class="badge outline"><?= esc(($accessOptions[$dataset['access_type'] ?? ''] ?? 'Public')) ?></span>
                            </div>
                            <h2 id="dataset-preview-title-<?= esc((string) $dataset['id']) ?>"><?= esc($dataset['title']) ?></h2>
                            <p class="preview-description" id="dataset-preview-summary-<?= esc((string) $dataset['id']) ?>"><?= esc($dataset['description']) ?></p>

                            <div class="preview-status-strip">
                                <div>
                                    <span class="preview-kicker">Access</span>
                                    <strong><?= esc(($accessOptions[$dataset['access_type'] ?? ''] ?? 'Public')) ?></strong>
                                    <?php if (($dataset['access_type'] ?? '') === 'public'): ?>
                                        <small>Visible in the public catalog.</small>
                                    <?php elseif (($dataset['access_type'] ?? '') === 'private'): ?>
                                        <small>Only the owner and repository administrators can inspect it.</small>
                                    <?php else: ?>
                                        <small>Login is required before download access is evaluated.</small>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="preview-kicker">Version</span>
                                    <strong><?= esc($dataset['version'] ?? '1.0') ?></strong>
                                    <small><?= ! empty($dataset['created_at']) ? esc(date('M d, Y', strtotime($dataset['created_at']))) : 'Date not recorded' ?></small>
                                </div>
                            </div>

                            <dl class="preview-meta">
                                <div>
                                    <dt>Contributor</dt>
                                    <dd><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></dd>
                                </div>
                                <div>
                                    <dt>Data Type</dt>
                                    <dd><?= esc($dataset['data_type'] ?: 'Not set') ?></dd>
                                </div>
                                <div>
                                    <dt>File Format</dt>
                                    <dd><?= esc($dataset['file_format'] ?: 'ZIP') ?></dd>
                                </div>
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
                                    <dd><?= esc($dataset['source_type'] ?: 'Not set') ?><?= ! empty($dataset['source_link']) ? ' - ' . esc($dataset['source_link']) : '' ?></dd>
                                </div>
                                <div>
                                    <dt>Tags</dt>
                                    <dd><?= esc($dataset['tags'] ?: 'No tags') ?></dd>
                                </div>
                                <?php if (! empty($dataset['created_at'])): ?>
                                    <div>
                                        <dt>Date Uploaded</dt>
                                        <dd><?= esc(date('M d, Y', strtotime($dataset['created_at']))) ?></dd>
                                    </div>
                                <?php endif; ?>
                            </dl>

                            <div class="preview-actions">
                                <a class="button" href="<?= site_url('datasets/' . $dataset['id']) ?>" data-preview-primary>Open Dataset Page</a>
                                <button class="button secondary" type="button" data-preview-close>Close Preview</button>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($pager)): ?>
            <div class="actions">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </section>
</section>

<script>
    const focusablePreviewSelector = 'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';

    document.querySelectorAll('.preview-trigger').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const modal = document.getElementById(trigger.dataset.previewTarget);
            if (!modal) return;

            modal.hidden = false;
            document.body.classList.add('preview-open');
            trigger.setAttribute('aria-expanded', 'true');
            (modal.querySelector('[data-preview-primary]') || modal.querySelector('.preview-card'))?.focus();
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
</script>
<?= $this->endSection() ?>
