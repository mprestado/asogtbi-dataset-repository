<?php

helper('url');

$error = [
    'code' => '500',
    'title' => 'Internal Server Error',
    'message' => 'Sorry! Something went wrong on our end. Please try again in a moment or go back and retry the action.',
    'actions' => [
        [
            'label' => 'Go to Home',
            'href' => site_url('/'),
            'variant' => 'primary',
        ],
        [
            'label' => 'Go Back',
            'behavior' => 'history-back',
            'variant' => 'secondary',
        ],
    ],
    'illustration' => '<img src="' . esc(base_url('assets/img/error_500.png'), 'attr') . '" alt="" width="110" height="110" loading="eager" decoding="async">',
];

include __DIR__ . DIRECTORY_SEPARATOR . '_error_layout.php';
