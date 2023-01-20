<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
// $routes->group('', ['filter' => 'login'], function ($routes) {

$routes->get('/', 'Regsosek2022::index');
$routes->get('/regsosek2022', 'Regsosek2022::index');

$routes->get('/regsosek2022/updateentrian', 'Regsosek2022::updateentrian');
$routes->post('/regsosek2022/updateentrian', 'Regsosek2022::updateentrian');

$routes->get('/regsosek2022/absensi', 'Regsosek2022::absensi');
$routes->get('/regsosek2022/arusdokumen', 'Regsosek2022::arusdokumen');
$routes->get('/regsosek2022/arusdokumen/(:num)', 'Regsosek2022::arusdokumenedit/$1');
$routes->post('/regsosek2022/arusdokumen/(:num)', 'Regsosek2022::arusdokumenedit/$1');

$routes->get('/regsosek2022/dokumenerror', 'Regsosek2022::dokumenerror');
$routes->get('/regsosek2022/dokumenerror/(:num)', 'Regsosek2022::dokumenerrorlihat/$1');
$routes->get('/regsosek2022/dokumenerror/(:num)/(:num)', 'Regsosek2022::dokumenerrorlihat/$1/$2');
$routes->post('/regsosek2022/dokumenerror/(:num)/(:num)', 'Regsosek2022::dokumenerrorlihat/$1/$2');

$routes->get('/regsosek2022/daftarsls', 'Regsosek2022::daftarsls');
$routes->get('/regsosek2022/petugas', 'Regsosek2022::petugas');
$routes->get('/regsosek2022/petugastambah', 'Regsosek2022::petugastambah');

$routes->get('/mitra', 'Mitra::index');
$routes->get('/mitra/tambah', 'Mitra::tambah');
$routes->post('/mitra/tambah', 'Mitra::tambah');
// $routes->get('/mitra/edit/(:alpha)', 'Mitra::edit/$1');
$routes->get('/mitra/edit/(:num)', 'Mitra::edit/$1');
// });

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
