<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/pasien', 'Pasien::index');
$routes->put('pasien/update/(:num)', 'Pasien::update/$1');
$routes->delete('pasien/(:num)', 'Pasien::delete/$1');
$routes->resource('pasien');
$routes->resource('obat');
