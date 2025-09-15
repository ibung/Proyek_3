<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/process', 'LoginController::process');
$routes->get('logout', 'LoginController::logout');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/save', 'RegisterController::save');

$routes->get('home', 'Home::index');
$routes->get('mhs', 'mahasiswa::index');
$routes->get('/mhs/edit/(:num)', 'mahasiswa::edit/$1');
$routes->get('/mhs/detail/(:segment)', 'mahasiswa::detail/$1'); // menggunakan NIM
$routes->get('/mhs/delete/(:num)', 'mahasiswa::delete/$1');
$routes->post('/mhs/create', 'mahasiswa::create');
$routes->post('/mhs/update', 'mahasiswa::update');
$routes->get('mhs/detail/(:num)', 'mahasiswa::detail/$1');



