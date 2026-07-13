<?= $this->extend('layouts/portal') ?>
<?= $this->section('content') ?>
<header class="portal-heading"><p class="eyebrow">Repository Administrator</p><h1>Governance overview</h1><p>Monitor every moderation stage and keep publication decisions accountable.</p></header>
<section class="portal-stat-grid">
<?php foreach ($statusLabels as $status => $label): ?>
    <article class="panel stat-card"><p class="tag"><?= esc($label) ?></p><h2 class="stat-value"><?= esc((string) ($counts[$status] ?? 0)) ?></h2></article>
<?php endforeach; ?>
</section>
<section class="panel portal-callout"><div><p class="tag">Moderation controls</p><h2>Assign, oversee, and publish</h2><p class="muted">Reviewers cannot self-assign. Publication remains locked until technical approval.</p></div><a class="button" href="<?= site_url('admin/datasets') ?>">Open moderation</a></section>
<?= $this->endSection() ?>
