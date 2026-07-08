<?php

if (! function_exists('dataset_citation')) {
    function dataset_citation(array $dataset): string
    {
        $title = $dataset['title'] ?? 'Untitled Dataset';
        $year = $dataset['year'] ?? date('Y');
        $publisher = $dataset['publisher'] ?? 'ASOG TBI Dataset Repository';

        return "{$title}. ({$year}). {$publisher}.";
    }
}

if (! function_exists('dataset_bibtex')) {
    function dataset_bibtex(array $dataset): string
    {
        $key = preg_replace('/[^A-Za-z0-9]+/', '', $dataset['title'] ?? 'dataset');
        $year = $dataset['year'] ?? date('Y');
        $title = $dataset['title'] ?? 'Untitled Dataset';
        $publisher = $dataset['publisher'] ?? 'ASOG TBI Dataset Repository';

        return "@misc{{$key}{$year},\n  title = {{$title}},\n  year = {{$year}},\n  publisher = {{$publisher}}\n}";
    }
}
