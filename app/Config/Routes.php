<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->get('/staging', 'Staging::index', ['filter' => 'login']);
$routes->get('/scan', 'Scan::index', ['filter' => 'login']);
$routes->get('/import', 'Import::index', ['filter' => 'login']);

// routes continent
$routes->get('/continent', 'Continent::index', ['filter' => 'login']);
$routes->delete('/continent/delete/(:any)', 'Continent::delete/$1');
$routes->get('/continent/edit/(:any)', 'Continent::edit/$1');
$routes->get('/continent/formadd', 'Continent::formadd');
$routes->post('/continent/save', 'Continent::save');
$routes->post('/continent/update/(:any)', 'Continent::update/$1');
// $routes->get('/continent/edit/(:segment)', 'Continent::edit/$1');

// routes customer
$routes->get('/customer', 'Customer::index', ['filter' => 'login']);
$routes->delete('/customer/delete/(:any)', 'Customer::delete/$1');
$routes->get('/customer/edit/(:any)', 'Customer::edit/$1');
$routes->get('/customer/formadd', 'Customer::formadd');
$routes->post('/customer/save', 'Customer::save');
$routes->post('/customer/update/(:any)', 'Customer::update/$1');

// routes product
$routes->get('/product', 'Product::index', ['filter' => 'login']);
$routes->delete('/product/delete/(:any)', 'Product::delete/$1');
$routes->get('/product/edit/(:any)', 'Product::edit/$1');
$routes->get('/product/formadd', 'Product::formadd');
$routes->post('/product/save', 'Product::save');
$routes->post('/product/update/(:any)', 'Product::update/$1');

// routes partnumber
$routes->get('/partnumber', 'Partnumber::index', ['filter' => 'login']);
$routes->delete('/partnumber/delete/(:any)', 'Partnumber::delete/$1');
$routes->get('/partnumber/edit/(:any)', 'Partnumber::edit/$1');
$routes->get('/partnumber/formadd', 'Partnumber::formadd');
$routes->post('/partnumber/save', 'Partnumber::save');
$routes->post('/partnumber/update/(:any)', 'Partnumber::update/$1');

// routes import
$routes->get('/import', 'Import::index', ['filter' => 'login']);
$routes->post('/import/simpanExcel', 'Import::simpanExcel');


// API
// $routes->resource('products');
$routes->resource('importapi');
// $routes->resource('scan');
// ngirim data or get data
// $routes->get('/tes/(:any), 'controller::method/$var1');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
