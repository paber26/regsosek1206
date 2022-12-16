<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Password\hash;

class Mitra extends BaseController
{
    protected $db;
    protected $users;

    public function __construct()
    {
        $this->db = db_connect();
        $this->users = $this->db->table('users');
    }

    public function index()
    {
        $data['title'] = 'Regsosek 2022';
        return view('templates/header', $data)
            . view('templates/sidebar')
            . view('templates/topbar')
            . view('mitra/index');
    }

    public function tambah()
    {
        // $db = db_connect();
        // $builder = $db->table('users');

        if ($this->request->getPost() != null) {
            // dd($this->request->getPost());
            // $sql = 'SELECT * FROM migrations';
            // dd($db->query($sql)->getResultArray());
            // dd($this->db->table('userinfo')->get());
            // dd(DB::table('users')->get());

            // dd($this->users->get()->getResult());

            // preparePassword()
            // dd(\Myth\Auth\Password::hash($this->request->getPost('password')));
            // dd(password_hash($this->request->getPost('password')));

            $data = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('email'),
                'password_hash' => \Myth\Auth\Password::hash($this->request->getPost('password')),
            ];

            // bin2hex('oke');
            // dd($data);       

            $this->users->insert($data);

            dd($this->users->get()->getResult());
        } else {
            $data['title']  = 'Regsosek 2022';
            return view('templates/header', $data)
                . view('templates/sidebar')
                . view('templates/topbar')
                . view('mitra/tambah');
        }
    }
}
