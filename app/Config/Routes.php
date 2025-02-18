<?php

use App\Controllers\KomplainController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('profil', 'AuthController::profil', ['filter' => 'login']);
$routes->post('profil/upload', 'AuthController::uploadProfile', ['filter' => 'login']);

$routes->group('admin', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('setting', 'SettingController::index');
    $routes->post('setting', 'SettingController::save');
});

$routes->group('data-master', ['filter' => 'login'], function($routes) {
    $routes->group('supir', function ($routes) {
        $routes->get('/', 'SupirController::index');              // Halaman daftar supir
        $routes->get('tambah', 'SupirController::tambah');        // Form tambah supir
        $routes->post('create', 'SupirController::create');       // Proses tambah supir
        $routes->get('edit/(:num)', 'SupirController::edit/$1');  // Form edit supir
        $routes->post('update/(:num)', 'SupirController::update/$1'); // Proses update supir
        $routes->get('delete/(:num)', 'SupirController::delete/$1'); // Hapus supir
    });

    $routes->group('pelanggan', function ($routes) {
        $routes->get('/', 'PelangganController::index');
        $routes->get('tambah', 'PelangganController::tambah');
        $routes->post('create', 'PelangganController::create');
        $routes->get('edit/(:num)', 'PelangganController::edit/$1');
        $routes->post('update/(:num)', 'PelangganController::update/$1');
        $routes->get('delete/(:num)', 'PelangganController::delete/$1');
    });
    $routes->group('kendaraan', ['filter' => 'login'], function($routes) {
        $routes->get('/', 'KendaraanController::index');              // Halaman daftar kendaraan
        $routes->get('tambah', 'KendaraanController::tambah');        // Form tambah kendaraan
        $routes->post('create', 'KendaraanController::create');       // Proses tambah kendaraan
        $routes->get('edit/(:num)', 'KendaraanController::edit/$1');  // Form edit kendaraan
        $routes->post('update/(:num)', 'KendaraanController::update/$1'); // Proses update kendaraan
        $routes->get('delete/(:num)', 'KendaraanController::delete/$1'); // Hapus kendaraan
    });
});


$routes->group('pengiriman', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'PengirimanController::index');                  // Halaman daftar pengiriman
    $routes->get('tambah', 'PengirimanController::tambah');            // Form tambah pengiriman
    $routes->post('create', 'PengirimanController::create');           // Proses tambah pengiriman
    $routes->get('edit/(:num)', 'PengirimanController::edit/$1');      // Form edit pengiriman
    $routes->post('update/(:num)', 'PengirimanController::update/$1'); // Proses update pengiriman
    $routes->get('delete/(:num)', 'PengirimanController::delete/$1');  // Hapus pengiriman
    $routes->get('cetak/(:num)', 'PengirimanController::cetakResi/$1');
    $routes->get('cetak_pdf', 'PengirimanController::cetakPDF');

});

$routes->group('komplain', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'KomplainController::index');
    $routes->get('tambah', 'KomplainController::tambah');
    $routes->post('simpan', 'KomplainController::simpan');
    $routes->get('delete/(:num)', 'KomplainController::delete/$1');
    $routes->get('edit/(:num)', 'KomplainController::edit/$1');
    $routes->post('update/(:num)', 'KomplainController::update/$1');
});

$routes->group('user', ['filter' => 'login'], function($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});


// $routes->get('/auth/login', 'AuthController::login');
// $routes->post('/auth/processLogin', 'AuthController::processLogin');
$routes->get('/auth/logout', 'AuthController::logout');

$routes->get('wilayah/provinsi', 'AjaxController::getProvinsi');
$routes->get('wilayah/kota/(:num)', 'AjaxController::getKota/$1');
$routes->get('wilayah/kecamatan/(:num)', 'AjaxController::getKecamatan/$1');
$routes->get('wilayah/kelurahan/(:num)', 'AjaxController::getKelurahan/$1');

// VIEW USER
$routes->get('/', 'Home::index');





