<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('forgot-password', 'Auth::forgotPassword');
$routes->post('forgot-password', 'Auth::sendResetLink');
$routes->get('reset-password', 'Auth::resetPassword');
$routes->post('reset-password', 'Auth::updatePassword');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('upload', 'DatasetUpload::create');
    $routes->post('upload', 'DatasetUpload::store');
    $routes->get('datasets/(:num)/edit', 'Datasets::edit/$1');
    $routes->post('datasets/(:num)/update', 'Datasets::update/$1');
    $routes->post('datasets/(:num)/archive', 'Datasets::archive/$1');
});

$routes->get('datasets', 'Datasets::index');
$routes->get('datasets/(:num)', 'Datasets::show/$1');
$routes->get('datasets/(:num)/download', 'Datasets::download/$1');
