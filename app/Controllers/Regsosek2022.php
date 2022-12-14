<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Regsosek2022 extends BaseController
{
    public function index()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/index');
    }

    public function absensi()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/absensi');
    }

    public function arusdokumen()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/arusdokumen');
    }

    public function arusdokumenid($kodewilayah)
    {
        // return $kodewilayah;
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/arusdokumenid');
    }

    public function petugas()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/petugas');
    }

    public function daftarsls()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/daftarsls');
    }
}
