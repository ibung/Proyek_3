<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('mhs', 'mahasiswa::index');
$routes->get('mhs/detail/(:num)', 'mahasiswa::detail/$1');

