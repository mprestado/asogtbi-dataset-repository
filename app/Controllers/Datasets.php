<?php

namespace App\Controllers;

class Datasets extends BaseController
{
    public function index(): string
    {
        return view('datasets/index', [
            'title' => 'Dataset Catalog',
        ]);
    }

    public function show(int $id): string
    {
        return view('datasets/show', [
            'title' => 'Dataset Detail',
            'datasetId' => $id,
        ]);
    }

    public function download(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id)
            ->with('info', 'Download authorization and file response are ready for Member 4 implementation.');
    }

    public function edit(int $id): string
    {
        return view('datasets/edit', [
            'title' => 'Edit Dataset',
            'datasetId' => $id,
        ]);
    }

    public function update(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id . '/edit')
            ->with('info', 'Dataset update logic is ready for Member 3 implementation.');
    }

    public function archive(int $id)
    {
        return redirect()
            ->to('/datasets/' . $id)
            ->with('info', 'Dataset archive logic is ready for Member 3 implementation.');
    }
}
