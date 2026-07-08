<?php

if (! function_exists('metadata_similarity_score')) {
    function metadata_similarity_score(array $current, array $candidate): int
    {
        $score = 0;

        foreach (['category', 'data_type', 'file_format'] as $field) {
            if (($current[$field] ?? null) && ($current[$field] ?? null) === ($candidate[$field] ?? null)) {
                $score += 2;
            }
        }

        $currentTags = array_filter(array_map('trim', explode(',', strtolower($current['tags'] ?? ''))));
        $candidateTags = array_filter(array_map('trim', explode(',', strtolower($candidate['tags'] ?? ''))));

        return $score + count(array_intersect($currentTags, $candidateTags));
    }
}
