<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

/**
 * --------------------------------------------------------------------
 * Router Configuration
 * --------------------------------------------------------------------
 */

$routes = Services::routes();

// --------------------------------------------------------------------
// Router Setup
// --------------------------------------------------------------------

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Rute untuk halaman utama
$routes->get('/', 'Home::index');

// Rute untuk halaman login
$routes->get('auth/login', 'Auth::index'); // Menampilkan halaman login
$routes->post('auth/login', 'Auth::login'); // Memproses login

// Rute untuk halaman register
$routes->get('auth/register', 'Auth::register'); // Menampilkan halaman register
$routes->post('auth/register/save', 'Auth::save'); // Memproses penyimpanan data register

// Rute untuk halaman lupa password
$routes->get('forgot-password', 'Auth::forgotPassword'); // Ganti dengan metode yang sesuai di Auth


// Rute 404
$routes->set404Override(function() {
    $message = 'The page you are looking for does not exist.'; // Pesan kesalahan kustom
    echo view('errors/html/error_404', ['message' => $message]);
});

// --------------------------------------------------------------------
// Additional Routing
// --------------------------------------------------------------------
// You can add additional routes here if needed
