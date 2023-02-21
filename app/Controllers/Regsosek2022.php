<?php

namespace App\Controllers;

// require 'vendor/autoload.php';

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Regsosek2022 extends BaseController
{
    protected $email;
    protected $user;

    protected $db;
    protected $users;
    protected $userinfo;
    protected $sls;
    protected $arusdokumen;
    protected $kondisisls;
    protected $dokumenerror;
    protected $absensi;
    protected $entrian;


    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
        $this->userinfo = $this->db->table('userinfo');

        $this->email = service('authentication')->user()->email;
        $this->user = $this->userinfo->where('email', $this->email)->get()->getRowArray();

        $this->sls = $this->db->table('sls');
        $this->arusdokumen = $this->db->table('regsosek2022_arusdokumen as ad');
        $this->dokumenerror = $this->db->table('regsosek2022_dokumenerror as de');
        $this->absensi = $this->db->table('regsosek2022_absensi as ab');
        $this->entrian = $this->db->table('regsosek2022_entrian as e');
        $this->kondisisls = $this->db->table('regsosek2022_kondisisls as e');
    }

    public function index()
    {
        $kec = $this->sls->select('k_kec, n_kec')->distinct('k_kec')->get()->getResultArray();

        $data['diterima_ipds'] = 0;
        $data['diterima_mitra'] = 0;
        $data['kembali_tu'] = 0;

        $data['progress'] = [];
        foreach ($kec as $k) {
            $total = $this->sls->where('k_kec', $k['k_kec'])->countAllResults();
            $tmp = $this->arusdokumen->like('k_wil', '1206' . $k['k_kec'])->get()->getResultArray();

            $diterima_ipds = 0;
            $diterima_mitra = 0;
            $kembali_tu = 0;
            foreach ($tmp as $t) {
                if ($t['diterima_ipds'] != '0000-00-00') {
                    $diterima_ipds++;
                }
                if ($t['diterima_mitra'] != '0000-00-00') {
                    $diterima_mitra++;
                }
                if ($t['kembali_tu'] != '0000-00-00') {
                    $kembali_tu++;
                }
            }

            $data['diterima_ipds'] += $diterima_ipds;
            $data['diterima_mitra'] += $diterima_mitra;
            $data['kembali_tu'] += $kembali_tu;


            array_push($data['progress'], [
                'k_kec' => $k['k_kec'],
                'n_kec' => $k['n_kec'],
                'total' => $total,
                'diterima_ipds' => $diterima_ipds,
                'persentase' => number_format((float)$diterima_ipds / $total * 100, '2'),
                'diterima_mitra' => $diterima_mitra,
                'kembali_tu' => $kembali_tu,
            ]);
        }

        $data['total_sls'] = $this->sls->countAllResults();
        $data['diterima_ipds_persen'] = number_format((float)$data['diterima_ipds'] / $data['total_sls'] * 100, '2');
        $data['diterima_mitra_persen'] = number_format((float)$data['diterima_mitra'] / $data['total_sls'] * 100, '2');
        $data['kembali_tu_persen'] = number_format((float)$data['kembali_tu'] / $data['total_sls'] * 100, '2');

        $data['entrian'] = $this->entrian->select('e.*, u.nama')
            ->join('userinfo as u', 'e.email = u.email', 'left')
            ->orderBy('e.total')->get()->getResultArray();


        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/index', $data);
    }

    public function updateentrian()
    {
        if (isset($_FILES["file"]["name"])) {
            $file_excel = $this->request->getFile('file');
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $render->load($file_excel);

            $data = $spreadsheet->getActiveSheet()->toArray();
            foreach ($data as $i => $row) {
                if ($i == 0) {
                    continue;
                }
                if ($this->entrian->where('email', $data[$i][0])->get()->getRowArray() == null) {
                    continue;
                } else {
                    $current = $this->entrian->where('email', $data[$i][0])->get()->getRowArray();
                    $dokclean   = $data[$i][3] - $current['lastentri'];
                    $dokwarning = $data[$i][4];
                    $dokerror   = $data[$i][5];
                    $doktotal   = $dokclean + $dokwarning + $dokerror;

                    $this->entrian->set([
                        'dok_clean' => $dokclean,
                        'dok_warning' => $dokwarning,
                        'dok_error' => $dokerror,
                        'total' => $doktotal
                    ])->where('email', $data[$i][0])->update();
                };
            }

            return redirect()->to(base_url('/regsosek2022'));
        } else {
            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/updateentrian');
        }
    }

    public function updatedokumenerror()
    {
        if (isset($_FILES["file"]["name"])) {

            $file_excel = $this->request->getFile('file');
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $render->load($file_excel);

            $data = $spreadsheet->getActiveSheet()->toArray();

            // $this->db->table('regsosek2022_dokumenerror')->emptyTable();

            foreach ($data as $i => $row) {
                if ($i == 0) {
                    continue;
                }
                $kodewilayah = str_split($data[$i][0], 16)[0];
                $nama_sls = $data[$i][1];
                $rt = $data[$i][2];
                $art = $data[$i][3];
                $validasi = $data[$i][6];
                $perlakuan = $data[$i][7];

                if (isset($data[$i][8])) {
                    $cek = $data[$i][8];
                } else {
                    $cek = 'belum';
                };
                if (isset($data[$i][9])) {
                    $catatan = $data[$i][9];
                } else {
                    $catatan = '';
                };


                $this->dokumenerror->insert([
                    'k_wil' => $kodewilayah,
                    'nama_sls' => $nama_sls,
                    'rt' => $rt,
                    'art' => $art,
                    'validasi' => $validasi,
                    'perlakuan' => $perlakuan,
                    'cek' => $cek,
                    'catatan' => $catatan
                ]);
            }

            return redirect()->to(base_url('/regsosek2022/dokumenerror'));
        } else {
            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/updateentrian');
        }
    }

    public function updatekondisisls()
    {
        if (isset($_FILES["file"]["name"])) {
            $file_excel = $this->request->getFile('file');
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $render->load($file_excel);

            $data = $spreadsheet->getActiveSheet()->toArray();

            $this->kondisisls->delete('id!=0');

            foreach ($data as $i => $row) {
                if ($i == 0) {
                    continue;
                }
                if ($i >= 908) {
                    continue;
                }

                $kode = strval($data[$i][0]);

                $sls = strval($data[$i][5]);
                if (strlen($sls) == 1) {
                    $sls = '000' . $sls;
                } else if (strlen($sls) == 2) {
                    $sls = '00' . $sls;
                }

                $subsls = '0' . strval($data[$i][6]);

                $kodewilayah = $kode . $sls . $subsls;
                $nama_sls = $data[$i][7];
                $blank = $data[$i][8];
                $clean = $data[$i][10];
                $warning = $data[$i][12];
                $error = $data[$i][14];
                $total = $data[$i][16];
                $vk = $data[$i][17];

                $this->kondisisls->insert([
                    'k_wil' => $kodewilayah,
                    'nama_sls' => $nama_sls,
                    'blank' => $blank,
                    'clean' => $clean,
                    'warning' => $warning,
                    'error' => $error,
                    'total' => $total,
                    'vk' => $vk
                ]);
            }

            return redirect()->to(base_url('/regsosek2022/kondisisls'));
        } else {
            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/updatekondisisls');
        }
    }

    public function absensi()
    {
        $data['kehadiran'] = $this->absensi->select('ab.*, userinfo.nama')
            ->join('userinfo', 'ab.email = userinfo.email', 'left')->get()->getResultArray();

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/absensi', $data);
    }

    public function arusdokumen()
    {
        $data['arusdokumen'] = $this->sls->select('sls.k_wil, arusdk.diterima_ipds, arusdk.diterima_mitra, arusdk.mitra, arusdk.kembali_tu, arusdk.ket')
            ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
            ->get()->getResultArray();

        // dd($data['arusdokumen']);
        return view('templates/header')
            . view('templates/sidebar', $this->user)
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

            $data['mitras'] = $this->userinfo->select('email, nama')
                ->where('regsosek2022', 1)->get()->getResultArray();

            // dd($data);

            return view('templates/header')
                . view('templates/sidebar', $this->user)
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
                    'diterima_ipds' => $this->request->getPost('diterima_ipds'),
                    'diterima_mitra' => $this->request->getPost('diterima_mitra'),
                    'mitra' => strtoupper($this->request->getPost('mitra')),
                    'kembali_tu' => $this->request->getPost('kembali_tu'),
                ])->where('k_wil', $kodewilayah)->update();
            }

            return redirect()->to(base_url('/regsosek2022/arusdokumen'));
        }
    }

    public function kondisisls()
    {
        $ksls = $this->kondisisls->get()->getResultArray();

        $data['kondisisls'] = [];
        foreach ($ksls as $d) {
            $mitra = $this->arusdokumen->where('k_wil', $d['k_wil'])->get()->getRowArray();

            array_push($data['kondisisls'], [
                'k_wil' => $d['k_wil'],
                'mitra' => $mitra == null ? '-' : $mitra['mitra'],
                'nama_sls' => $d['nama_sls'],
                'blank' => $d['blank'],
                'clean' => $d['clean'],
                'warning' => $d['warning'],
                'error' => $d['error'],
                'total' => $d['total'],
                'vk' => $d['vk'],
            ]);
        }

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/kondisisls', $data);
    }

    public function dokumenerror()
    {
        $de = $this->dokumenerror->select('k_wil')->distinct()->get()->getResultArray();

        $data['dokumenerror'] = [];
        foreach ($de as $d) {
            $mitra = $this->arusdokumen->where('k_wil', $d['k_wil'])->get()->getRowArray();

            array_push($data['dokumenerror'], [
                'k_wil' => $d['k_wil'],
                'mitra' => $mitra == null ? '-' : $mitra['mitra'],
                'total_error' => $this->dokumenerror->where('k_wil', $d['k_wil'])->countAllResults(),
                'diperbaiki' => $this->dokumenerror->where('k_wil', $d['k_wil'])->where('cek', 'sudah')->countAllResults()
            ]);
        }

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/dokumenerror', $data);
    }

    public function dokumenerrorlihat($kodewilayah, $id = null)
    {
        if ($id == null) {
            $data['dokumenerror'] = $this->arusdokumen->where('ad.k_wil', $kodewilayah)
                ->join('regsosek2022_dokumenerror as e', 'ad.k_wil = e.k_wil')
                ->get()->getResultArray();

            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/dokumenerrorlihat', $data);
        } else {
            if ($this->request->getPost() != null) {

                $this->dokumenerror->set([
                    'catatan' => $this->request->getPost('catatan'),
                ])->where('id', $id)->update();

                return redirect()->to(base_url('/regsosek2022/dokumenerror/' . $kodewilayah));
            } else {

                $data['arusdokumen'] = $this->sls->select('sls.*, arusdk.mitra, arusdk.ket')
                    ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
                    ->where('sls.k_wil', $kodewilayah)
                    ->get()->getRowArray();

                $data['dokumenerror'] = $this->dokumenerror->where('id', $id)->get()->getRowArray();

                return view('templates/header')
                    . view('templates/sidebar', $this->user)
                    . view('templates/topbar')
                    . view('regsosek2022/dokumenerroredit', $data);
            }
        }
    }

    public function dokumenerrorcek($kodewilayah, $id, $cek)
    {
        if ($cek == 'sudah') {
            $this->dokumenerror->set([
                'cek' => 'sudah'
            ])->where('id', $id)->update();
        } else if ($cek == 'belum') {
            $this->dokumenerror->set([
                'cek' => 'belum'
            ])->where('id', $id)->update();
        }
        return redirect()->to(base_url('/regsosek2022/dokumenerror/' . $kodewilayah));
    }

    public function petugas()
    {
        $data['petugas'] = $this->userinfo->where('regsosek2022', 1)->get()->getResultArray();
        // dd($data);

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/petugas', $data);
    }

    public function petugastambah()
    {
        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/petugastambah');
    }

    public function daftarsls()
    {
        $data['slss'] = $this->sls->get()->getResultArray();
        // dd($data['slss']);

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/daftarsls', $data);
    }
}
