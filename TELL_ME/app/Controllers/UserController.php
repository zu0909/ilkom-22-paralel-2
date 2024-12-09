<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    public function searchProfile()
    {
        $search = $this->request->getGet('search'); // Ambil parameter pencarian
        $model = new UserModel();

        // Query pencarian hanya untuk profil (nama, email, telepon)
        $users = $model->select('username, bio')
                       ->like('username', $search)
                       ->findAll();

        // Return data dalam format JSON
        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
                              ->setJSON($users);
    }
    
    public function Profile()
    {
        $session = session();
    
        // Cek apakah pengguna sudah login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }
    
        // Ambil data pengguna dari database
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $session->get('username'))->first();
    
        // Jika pengguna tidak ditemukan
        if (!$user) {
            return redirect()->to('/auth/dashboard')->with('error', 'User not found.');
        }
    
        // Kirim data pengguna ke view
        return view('profile/index', ['user' => $user]);
    }

    
}    

