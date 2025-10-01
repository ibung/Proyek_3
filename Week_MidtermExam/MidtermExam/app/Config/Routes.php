<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//====================================================================
// RUTE PUBLIK
//====================================================================
// Rute ini bisa diakses oleh siapa saja, bahkan yang belum login.
//--------------------------------------------------------------------
$routes->get('/', 'LoginController::index');
$routes->get('login', 'LoginController::index');
$routes->post('login/process', 'LoginController::process');

//====================================================================
// RUTE YANG MEMBUTUHKAN OTENTIKASI (LOGIN)
//====================================================================
// Semua rute di dalam grup ini hanya bisa diakses setelah login.
//--------------------------------------------------------------------
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    
    // Rute Umum (Bisa diakses Admin & Mahasiswa)
    $routes->get('home', 'Home::index');
    $routes->get('logout', 'LoginController::logout');
    $routes->get('/', 'Home::index');

    //----------------------------------------------------------------
    // RUTE KHUSUS MAHASISWA
    //----------------------------------------------------------------
    $routes->get('dashboard/detail', 'DashboardController::myDetail');
    $routes->get('dashboard/courses', 'DashboardController::myCourses');
    $routes->get('dashboard/enroll', 'DashboardController::enroll');
    $routes->post('dashboard/enroll/save', 'DashboardController::saveEnrollment');

    //----------------------------------------------------------------
    // RUTE KHUSUS ADMIN
    //----------------------------------------------------------------
    // Grup ini memiliki filter tambahan, yaitu 'admin'.
    // Hanya user dengan role 'admin' yang bisa mengaksesnya.
    //----------------------------------------------------------------
    $routes->group('admin', ['filter' => 'admin'], static function ($routes) {
        // Pendaftaran Mahasiswa oleh Admin
        $routes->get('register', 'RegisterController::index');
        $routes->post('register/process', 'RegisterController::process');

        // Manajemen Data Mahasiswa (CRUD)
        $routes->get('students', 'StudentController::index');
        $routes->get('students/detail/(:num)', 'StudentController::detail/$1');
        $routes->get('students/edit/(:num)', 'StudentController::edit/$1');
        $routes->post('students/update/(:num)', 'StudentController::update/$1');
        $routes->get('students/delete/(:num)', 'StudentController::delete/$1');

        // Manajemen Mata Kuliah Mahasiswa
        $routes->get('students/(:num)/enroll', 'StudentController::enroll/$1');
        $routes->post('students/(:num)/enroll/save', 'StudentController::saveEnrollment/$1');

        // === TAMBAHKAN BLOK INI UNTUK KELOLA MATA KULIAH ===
        $routes->get('courses', 'CourseController::index');
        $routes->get('courses/new', 'CourseController::new');
        $routes->post('courses/create', 'CourseController::create');
        $routes->get('courses/edit/(:num)', 'CourseController::edit/$1');
        $routes->post('courses/update/(:num)', 'CourseController::update/$1');
        $routes->get('courses/delete/(:num)', 'CourseController::delete/$1');
    });
});