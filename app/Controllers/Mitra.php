<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Mitra extends BaseController
{
    public function index()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('mitra/index');
    }

    public function tambah()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('mitra/tambah');
    }
}
