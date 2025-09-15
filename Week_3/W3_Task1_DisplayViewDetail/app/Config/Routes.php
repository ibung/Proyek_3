<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/hello', 'Dosen::display');
// $routes->get('/home', 'Home::index');
// $routes->get('/berita', 'Berita::index');
$routes->get('/', 'Mahasiswa::index');
$routes->get('mhs', 'Mahasiswa::index');
$routes->get('mhs/detail/(:num)', 'Mahasiswa::detail/$1');

