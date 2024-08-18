<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProyekController::index');
$routes->get('create-proyek', 'ProyekController::create');
$routes->post('/', 'ProyekController::store');
$routes->delete('proyek/(:num)', 'ProyekController::delete/$1');
$routes->get('edit-proyek/(:num)', 'ProyekController::edit/$1');
$routes->put('/', 'ProyekController::update');

$routes->get('lokasi', 'LokasiController::index');
$routes->get('create-lokasi', 'LokasiController::create');
$routes->post('lokasi', 'LokasiController::store');
$routes->delete('lokasi/(:num)', 'LokasiController::delete/$1');
$routes->put('lokasi', 'LokasiController::edit');
