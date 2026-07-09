<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

// MVP development mode: keep all skeleton views reachable while Google school-email auth is pending.
// Re-enable the auth and role filters when authentication becomes part of the implementation sprint.
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

$routes->group('admin', ['filter' => 'role:admin'], static function (RouteCollection $routes): void {
    $routes->get('/', 'Admin::index');
    $routes->get('users', 'Admin::users');
    $routes->post('users/(:num)/activate', 'Admin::activateUser/$1');
    $routes->post('users/(:num)/deactivate', 'Admin::deactivateUser/$1');
    $routes->get('datasets', 'Admin::datasets');
    $routes->post('datasets/(:num)/approve', 'Admin::approveDataset/$1');
    $routes->post('datasets/(:num)/reject', 'Admin::rejectDataset/$1');
    $routes->get('audit-logs', 'Admin::auditLogs');
});
