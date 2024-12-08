<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        // Data pengguna bisa didapat dari session
        $data['username'] = session()->get('username');
        $data['email'] = session()->get('email'); // Sesuaikan key-nya dengan session Anda

        return view('profile/index', $data);
    }
}
