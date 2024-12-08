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
$routes->get('/', 'Auth::index');
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::save');
$routes->get('/auth/ds', 'Auth::dashboard');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('profile/index', 'Profile::index');

// Rute 404
$routes->set404Override(function () {
    $message = 'The page you are looking for does not exist.'; // Pesan kesalahan kustom
    echo view('errors/html/error_404', ['message' => $message]);
});

// --------------------------------------------------------------------
// Additional Routing
// --------------------------------------------------------------------
// You can add additional routes here if needed
// --------------------------------------------------------------------
// Additional Routing
// --------------------------------------------------------------------
// You can add additional routes here if needed
