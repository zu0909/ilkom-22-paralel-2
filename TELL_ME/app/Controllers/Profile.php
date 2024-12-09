<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        // Data pengguna bisa didapat dari session
        $data['username'] = session()->get('username');
        $data['email'] = session()->get('email'); // Sesuaikan key-nya dengan session Anda

        // Data tambahan untuk profil
        $data['bio'] = 'This is a sample bio'; // Ganti dengan data bio yang sebenarnya
        $data['followersCount'] = 100; // Ganti dengan jumlah pengikut yang sebenarnya

        // Data postingan
        $data['posts'] = [
            [
                'id' => 1,
                'author' => 'John Doe',
                'time' => '2 hours',
                'content' => 'This is a sample post.'
            ],
            [
                'id' => 2,
                'author' => 'Jane Doe',
                'time' => '5 hours',
                'content' => 'Another example post.'
            ]
        ];

        return view('profile/index', $data);
    }
}