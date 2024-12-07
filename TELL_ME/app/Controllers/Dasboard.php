<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        // Mengarahkan ke file view `Views/Beranda/Index.php`
        return view('Beranda/home');
    }
}
