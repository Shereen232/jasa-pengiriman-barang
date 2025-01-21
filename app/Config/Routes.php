<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/data-master/supir', 'SupirController::index');
$routes->get('/data-master/supir/tambah', 'SupirController::tambah');

$routes->get('/data-master/pelanggan', 'PelangganController::index');

$routes->get('/data-master/kendaraan', 'KendaraanController::index');
$routes->get('/data-master/kendaraan/tambah', 'KendaraanController::tambah');
// VIEW USER
$routes->get('/', 'Home::index');
