<?php

namespace App\Controllers;

class DatasetUpload extends BaseController
{
    public function create(): string
    {
        return view('upload/create', [
            'title' => 'Upload Dataset',
            'dataTypes' => ['Tabular', 'Text', 'Image', 'Audio', 'Video'],
            'sourceTypes' => ['Primary', 'Secondary'],
            'accessTypes' => ['public', 'restricted'],
            'requiredMetadata' => [
                'Title',
                'Description',
                'Tags',
                'Category',
                'Data type',
                'File format',
                'Research title',
                'Project head or adviser',
                'Source type',
                'ZIP file',
            ],
        ]);
    }

    public function store()
    {
        return redirect()
            ->to('/upload')
            ->with('info', 'Dataset upload validation and storage are ready for Member 3 implementation.');
    }
}
