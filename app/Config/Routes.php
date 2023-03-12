<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'checkauth']);
$routes->get('/login', 'Auth::index', ['filter' => 'auth']);
$routes->post('/auth', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/ganti-password', 'Auth::changepassword', ['filter' => 'checkauth']);
$routes->post('/ganti-password/change', 'Auth::change', ['filter' => 'checkauth']);
$routes->get('/daftar-role', 'Roles::index', ['filter' => 'checkauth']);
$routes->post('/daftar-role/save', 'Roles::save');
$routes->post('/daftar-role/update', 'Roles::update');
$routes->get('/daftar-role/delete/(:segment)', 'Roles::delete/$1', ['filter' => 'checkauth']);
$routes->get('/daftar-user', 'Users::index', ['filter' => 'checkauth']);
$routes->get('/daftar-user/tambah', 'Users::add', ['filter' => 'checkauth']);
$routes->get('/daftar-user/save', 'Users::save', ['filter' => 'checkauth']);
$routes->post('/daftar-user/save', 'Users::save');
$routes->get('/daftar-user/edit/(:segment)', 'Users::edit/$1', ['filter' => 'checkauth']);
$routes->post('/daftar-user/update', 'Users::update');
$routes->get('/daftar-user/delete/(:segment)', 'Users::delete/$1', ['filter' => 'checkauth']);
$routes->get('/daftar-menu', 'Menus::index', ['filter' => 'checkauth']);
$routes->get('/daftar-menu/tambah', 'Menus::add', ['filter' => 'checkauth']);
$routes->post('/daftar-menu/save', 'Menus::save');
$routes->get('/daftar-menu/edit/(:segment)', 'Menus::edit/$1', ['filter' => 'checkauth']);
$routes->post('/daftar-menu/update', 'Menus::update');
$routes->get('/daftar-menu/delete/(:segment)', 'Menus::delete/$1', ['filter' => 'checkauth']);
$routes->get('/akses-role', 'AksesRole::index', ['filter' => 'checkauth']);
$routes->get('/akses-role/akses/(:segment)', 'AksesRole::aksesList/$1', ['filter' => 'checkauth']);
$routes->post('/akses-role/gantiakses', 'AksesRole::gantiAkses', ['filter' => 'checkauth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
