<?php

helper('url');

$backUrl = previous_url();

if (! $backUrl || $backUrl === current_url()) {
    $backUrl = site_url('/');
}

$error = [
    'code' => '404',
    'title' => 'Page Not Found',
    'message' => "The page you're looking for may have been moved, deleted, or the URL is incorrect.",
    'illustration' => <<<'SVG'
<svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
    <path d="M34 24h34l18 18v54a4 4 0 0 1-4 4H34a4 4 0 0 1-4-4V28a4 4 0 0 1 4-4Z" stroke="currentColor" stroke-width="4" stroke-linejoin="round"/>
    <path d="M68 24v18h18" stroke="currentColor" stroke-width="4" stroke-linejoin="round"/>
    <path d="M48 58h24" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
    <path d="M48 72h32" stroke="currentColor" stroke-width="4" stroke-linecap="round" opacity=".6"/>
    <circle cx="83" cy="80" r="14" stroke="currentColor" stroke-width="4"/>
    <path d="m92 90 10 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
</svg>
SVG,
    'actions' => [
        [
            'label' => 'Go to Home',
            'href' => site_url('/'),
            'variant' => 'primary',
        ],
        [
            'label' => 'Go Back',
            'href' => $backUrl,
            'variant' => 'secondary',
        ],
    ],
];

include __DIR__ . DIRECTORY_SEPARATOR . '_error_layout.php';
