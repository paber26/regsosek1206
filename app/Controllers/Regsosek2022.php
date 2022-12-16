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

    public function arusdokumenedit($kodewilayah)
    {
        if ($this->request->getPost() == null) {
            $data['arusdokumen'] = $this->sls->select('sls.*, arusdk.diterima_ipds, arusdk.diterima_mitra, arusdk.mitra, arusdk.kembali_tu, arusdk.ket')
                ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
                ->where('sls.k_wil', $kodewilayah)
                ->get()->getRowArray();

            // dd($data);

            return view('templates/header')
                . view('templates/sidebar')
                . view('templates/topbar')
                . view('regsosek2022/arusdokumenedit', $data);
        } else {
            if ($this->arusdokumen->where('k_wil', $kodewilayah)->get()->getResult() == null) {
                $this->arusdokumen->insert([
                    'k_wil' => $kodewilayah,
                    'ket' => strtoupper($this->request->getPost('ket')),
                    'diterima_ipds' => $this->request->getPost('diterima_ipds'),
                    'diterima_mitra' => $this->request->getPost('diterima_mitra'),
                    'mitra' => strtoupper($this->request->getPost('mitra')),
                    'kembali_tu' => $this->request->getPost('kembali_tu'),
                ]);
            } else {
                $this->arusdokumen->set([
                    'ket' => strtoupper($this->request->getPost('ket')),
                    'diterima_mitra' => $this->request->getPost('diterima_mitra'),
                    'mitra' => strtoupper($this->request->getPost('mitra')),
                    'kembali_tu' => $this->request->getPost('kembali_tu'),
                ])->where('k_wil', $kodewilayah)->update();
            }

            return redirect()->to('/regsosek2022/arusdokumen');
        }
    }

    public function petugas()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/petugas');
    }

    public function petugastambah()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('regsosek2022/petugastambah');
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
