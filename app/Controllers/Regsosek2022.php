<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Regsosek2022 extends BaseController
{
    protected $db;
    protected $users;
    protected $userinfo;
    protected $sls;
    protected $arusdokumen;


    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
        $this->userinfo = $this->db->table('userinfo');
        $this->sls = $this->db->table('sls');
        $this->arusdokumen = $this->db->table('regsosek2022_arusdokumen');
    }

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
        $data['arusdokumen'] = $this->sls->select('sls.k_wil, arusdk.diterima_ipds, arusdk.diterima_mitra, arusdk.mitra, arusdk.kembali_tu, arusdk.ket')
            ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
            ->get()->getResultArray();

        // dd($data['arusdokumen']);
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/arusdokumen', $data);
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
        $data['slss'] = $this->sls->get()->getResultArray();
        // dd($data['slss']);

        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/daftarsls', $data);
    }
}
