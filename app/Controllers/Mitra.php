<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Password\hash;

class Mitra extends BaseController
{
    protected $db;
    protected $users;
    protected $userinfo;

    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
        $this->userinfo = $this->db->table('userinfo');
    }

    public function index()
    {
        // $data['title'] = 'Regsosek 2022';
        // $data['mitras'] = $this->userinfo->get()->getResultArray();
        $data['mitras'] = $this->userinfo->select('userinfo.*, users.created_at')
            ->join('users', 'userinfo.email = users.email', 'left')->get()->getResultArray();
        // dd($data);

        return view('templates/header')
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('mitra/index', $data);
    }

    public function tambah()
    {
        if ($this->request->getPost() != null) {

            $this->users->insert([
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('email'),
                'password_hash' => \Myth\Auth\Password::hash($this->request->getPost('password')),
            ]);

            $this->userinfo->insert([
                'email' => $this->request->getPost('email'),
                'nama' => $this->request->getPost('nama'),
                'alamat' => $this->request->getPost('alamat'),
                'tlahir' => $this->request->getPost('tlahir'),
                'wa' => $this->request->getPost('wa')
            ]);
        } else {
            return view('templates/header')
                . view('templates/sidebar')
                . view('templates/topbar')
                . view('mitra/tambah');
        }
    }
}
