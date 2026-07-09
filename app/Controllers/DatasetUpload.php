<?php

namespace App\Controllers;

class DatasetUpload extends BaseController
{
    public function create(): string
    {
        return view('upload/create', [
            'title' => 'Upload Dataset',
        ]);
    }

    public function store()
    {
        return redirect()
            ->to('/upload')
            ->with('info', 'Dataset upload validation and storage are ready for team implementation.');
    }
}
