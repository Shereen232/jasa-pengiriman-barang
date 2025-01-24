<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'DashboardController::index');
$routes->group('data-master/supir', function ($routes) {
    $routes->get('/', 'SupirController::index');              // Halaman daftar supir
    $routes->get('tambah', 'SupirController::tambah');        // Form tambah supir
    $routes->post('create', 'SupirController::create');       // Proses tambah supir
    $routes->get('edit/(:num)', 'SupirController::edit/$1');  // Form edit supir
    $routes->post('update/(:num)', 'SupirController::update/$1'); // Proses update supir
    $routes->get('delete/(:num)', 'SupirController::delete/$1'); // Hapus supir
});

$routes->group('data-master/pelanggan', function ($routes) {
    $routes->get('/', 'PelangganController::index');
    $routes->get('tambah', 'PelangganController::tambah');
    $routes->post('create', 'PelangganController::create');
    $routes->get('edit/(:num)', 'PelangganController::edit/$1');
    $routes->post('update/(:num)', 'PelangganController::update/$1');
    $routes->get('delete/(:num)', 'PelangganController::delete/$1');
});

$routes->group('data-master/kendaraan', function ($routes) {
    $routes->get('/', 'KendaraanController::index');              // Halaman daftar kendaraan
    $routes->get('tambah', 'KendaraanController::tambah');        // Form tambah kendaraan
    $routes->post('create', 'KendaraanController::create');       // Proses tambah kendaraan
    $routes->get('edit/(:num)', 'KendaraanController::edit/$1');  // Form edit kendaraan
    $routes->post('update/(:num)', 'KendaraanController::update/$1'); // Proses update kendaraan
    $routes->get('delete/(:num)', 'KendaraanController::delete/$1'); // Hapus kendaraan
});

// VIEW USER
$routes->get('/', 'Home::index');
