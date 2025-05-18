<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    // route login tidak butuh token
    $routes->post('login', 'AuthController::login');
    // route yang butuh token
    $routes->get('profile', 'UserController::profile', ['filter' => 'authJWT']);
});
$routes->resource('user', ['controller' => 'UserController']);
$routes->resource('mahasiswa', ['controller' => 'MahasiswaController']);
$routes->resource('dosen', ['controller' => 'DosenController']);
$routes->resource('ruangan', ['controller' => 'RuanganController']);
$routes->resource('penguji', ['controller' => 'PengujiSidangController']);
$routes->resource('jadwal', ['controller' => 'JadwalSidangController']);
$routes->resource('view_jadwal', ['controller' => 'ViewJadwalSidangController']);
$routes->resource('view_penguji', ['controller' => 'ViewPengujiSidangController']);
$routes->resource('view_penjadwalan', ['controller' => 'ViewPenjadwalanController']);

