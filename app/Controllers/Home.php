<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index', [
            'title' => 'ASOG TBI Dataset Repository',
        ]);
    }
}
