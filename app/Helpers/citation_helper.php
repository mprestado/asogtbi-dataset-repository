<?php

if (! function_exists('dataset_citation')) {
    function dataset_citation(array $dataset): string
    {
        $title = $dataset['title'] ?? 'Untitled Dataset';
        $author = trim((string) ($dataset['author'] ?? $dataset['contributor'] ?? ''));
        $year = $dataset['year'] ?? date('Y');
        $publisher = $dataset['publisher'] ?? 'ASOG TBI Dataset Repository';

        if ($author === '') {
            return "{$title}. ({$year}). {$publisher}.";
        }

        return "{$author}. ({$year}). {$title}. {$publisher}.";
    }
}

if (! function_exists('dataset_bibtex')) {
    function dataset_bibtex(array $dataset): string
    {
        $key = preg_replace('/[^A-Za-z0-9]+/', '', $dataset['title'] ?? 'dataset');
        $year = $dataset['year'] ?? date('Y');
        $title = $dataset['title'] ?? 'Untitled Dataset';
        $author = trim((string) ($dataset['author'] ?? $dataset['contributor'] ?? ''));
        $publisher = $dataset['publisher'] ?? 'ASOG TBI Dataset Repository';
        $authorLine = $author !== '' ? "\n  author = {{$author}}," : '';

        return "@misc{{$key}{$year},{$authorLine}\n  title = {{$title}},\n  year = {{$year}},\n  publisher = {{$publisher}}\n}";
    }
}
