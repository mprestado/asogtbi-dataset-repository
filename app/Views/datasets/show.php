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
?>
<section class="hero-panel">
    <div class="shell">
        <p class="eyebrow">Dataset Detail</p>
        <h1><?= esc($dataset['title']) ?></h1>
        <p class="lead"><?= esc($dataset['category'] ?: 'Uncategorized') ?> &middot; <?= esc($dataset['data_type'] ?: 'Dataset') ?> &middot; <?= esc($accessLabel ?? 'Public') ?></p>
        <?php if (! empty($isOwner)): ?>
            <span class="status-pill status-<?= esc($dataset['status'] ?? 'unknown') ?>"><?= esc($statusLabel ?? 'Unknown') ?></span>
        <?php endif; ?>
    </div>
</section>

<section class="shell split-grid form-shell">
    <article class="panel">
        <p class="tag">Metadata</p>
        <h2>Description</h2>
        <p><?= esc($dataset['description']) ?></p>
        <dl class="meta-list">
            <div>
                <dt>Research Title</dt>
                <dd><?= esc($dataset['research_title'] ?: 'Not set') ?></dd>
            </div>
            <div>
                <dt>Project Head</dt>
                <dd><?= esc($dataset['project_head'] ?: 'Not set') ?></dd>
            </div>
            <div>
                <dt>Members</dt>
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
        </dl>
    </article>

    <aside class="panel detail-sidebar">
        <p class="tag">Dataset File</p>
        <h2>Download and cite</h2>
        <dl class="meta-list">
            <div>
                <dt>Contributor</dt>
                <dd><?= esc($dataset['author_name'] ?? 'Unknown contributor') ?></dd>
            </div>
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
            <?php if (! empty($latestFile)): ?>
                <div>
                    <dt>File</dt>
                    <dd><?= esc($latestFile['original_name']) ?> (<?= esc(number_format((int) $latestFile['file_size'])) ?> bytes)</dd>
                </div>
            <?php endif; ?>
        </dl>
        <div class="actions">
            <a class="button" href="<?= site_url('datasets/' . $datasetId . '/download') ?>">Download ZIP</a>
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
                <a class="button secondary" href="<?= site_url('datasets/' . $datasetId . '/edit') ?>">Edit</a>
            <?php endif; ?>
        </div>
    </aside>
</section>

<section class="shell content-section">
    <div class="grid">
        <div class="panel">
            <p class="tag">Recommendations</p>
            <h2>Similar datasets</h2>
            <?php if (empty($recommendations)): ?>
                <p class="muted">No metadata-based recommendations are available yet.</p>
            <?php else: ?>
                <ul class="record-list">
                    <?php foreach ($recommendations as $recommended): ?>
                        <li>
                            <strong><a href="<?= site_url('datasets/' . $recommended['id']) ?>"><?= esc($recommended['title']) ?></a></strong>
                            <span class="muted"><?= esc($recommended['category']) ?> &middot; score <?= esc((string) $recommended['score']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
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
        if (event.key !== 'Escape') return;

        const openModal = document.querySelector('.citation-modal:not([hidden])');
        if (openModal) closeCitation(openModal);
    });
</script>
<?= $this->endSection() ?>
