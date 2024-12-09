<?php

namespace App\Controllers;
use App\Models\UserModel;

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

    public function edit()
{
    // Ambil username dari session
    $username = session()->get('username');
    
    // Inisialisasi model pengguna
    $userModel = new UserModel;
    
    // Ambil data pengguna dari database berdasarkan username
    $user = $userModel->where('username', $username)->first();
    
    // Kirim data pengguna ke tampilan
    $data['username'] = $user['username'] ?? ''; // Ambil username dari database, gunakan default jika tidak ada
    $data['email'] = $user['email'] ?? '';       // Ambil email dari database, gunakan default jika tidak ada
    $data['bio'] = $user['bio'] ?? '';           // Ambil bio dari database, gunakan default jika tidak ada
    $data['profile_picture'] = $user['profile_picture'] ?? ''; // Ambil gambar profil
    
    return view('profile/edit', $data);
}

public function update()
{
    // Ambil username dari session
    $username = session()->get('username'); // Ambil username dari session
    $userModel = new UserModel();

    // Ambil data dari form
    $bio = $this->request->getPost('bio');

    // Validasi input
    $validation = \Config\Services::validation();
    $validation->setRules([
        'bio' => 'permit_empty|max_length[255]',
        'profile_picture' => 'mime_in[profile_picture,image/jpg,image/jpeg,image/gif,image/png]|max_size[profile_picture,2048]'
    ]);

    if (!$this->validate($validation->getRules())) {
        // Jika validasi gagal, kembalikan ke tampilan dengan error
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Proses upload gambar jika ada
    $profilePicturePath = null;
    $profilePicture = $this->request->getFile('profile_picture');
    if ($profilePicture->isValid() && !$profilePicture->hasMoved()) {
        $newName = $profilePicture->getRandomName();
        if ($profilePicture->move(WRITEPATH . 'uploads', $newName)) {
            $profilePicturePath = 'uploads/' . $newName;
        } else {
            // Jika gagal memindahkan file, gunakan gambar lama
            log_message('error', 'Failed to move uploaded file.');
            $user = $userModel->where('username', $username)->first();
            $profilePicturePath = $user['profile_picture'];
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $user = $userModel->where('username', $username)->first();
        $profilePicturePath = $user['profile_picture'];
    }

    // Update data pengguna
    $updateResult = $userModel->where('username', $username)->set([
        'bio' => $bio,
        'profile_picture' => $profilePicturePath
    ])->update();

    if (!$updateResult) {
        log_message('error', 'Failed to update user profile.');
        return redirect()->back()->with('errors', ['Failed to update profile.']);
    }

    // Perbarui session dengan data baru
    session()->set([
        'bio' => $bio,
        'profile_picture' => $profilePicturePath // Jika Anda ingin menyimpan gambar profil baru di session
    ]);

    // Redirect ke halaman profil setelah update
    return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
}
}