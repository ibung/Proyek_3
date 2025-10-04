<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->addRedirect('/', 'login');
$routes->get('login', 'LoginController::index');
$routes->post('login/process', 'LoginController::process');
$routes->get('logout', 'LoginController::logout');

// role gudang
$routes->group('gudang', ['filter' => 'auth:gudang'], static function ($routes) {
    $routes->get('dashboard', 'GudangController::index');

    $routes->get('bahan/new', 'GudangController::new');
    $routes->post('bahan/create', 'GudangController::create');

    $routes->get('bahan/edit/(:num)', 'GudangController::edit/$1');
    $routes->post('bahan/update/(:num)', 'GudangController::update/$1');

    $routes->post('bahan/delete/(:num)', 'GudangController::delete/$1');

    $routes->get('permintaan', 'GudangController::permintaanList');
    $routes->post('permintaan/approve/(:num)', 'GudangController::approveRequest/$1');
    $routes->post('permintaan/reject/(:num)', 'GudangController::rejectRequest/$1');
});

// role dapur
$routes->group('dapur', ['filter' => 'auth:dapur'], static function ($routes) {
    $routes->get('dashboard', 'DapurController::index');

    $routes->get('permintaan/new', 'DapurController::newRequest');
    $routes->post('permintaan/create', 'DapurController::createRequest');
});