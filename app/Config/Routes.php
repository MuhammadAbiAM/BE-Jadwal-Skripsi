<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('user', 'UserController::index');
$routes->resource('mahasiswa', ['controller' => 'MahasiswaController']);
$routes->resource('dosen', ['controller' => 'DosenController']);
$routes->resource('ruangan', ['controller' => 'RuanganController']);
$routes->resource('penguji_sidang', ['controller' => 'PengujiSidangController']);
$routes->resource('jadwal_sidang', ['controller' => 'JadwalSidangController']);
$routes->resource('view_jadwal_sidang', ['controller' => 'ViewJadwalSidangController']);
$routes->resource('view_penguji_sidang', ['controller' => 'ViewPengujiSidangController']);
$routes->resource('view_penjadwalan', ['controller' => 'ViewPenjadwalanController']);

