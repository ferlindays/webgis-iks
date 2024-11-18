<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/signin', 'Auth::index');
$routes->post('/signin', 'Auth::login');

$routes->get('/signup', 'Auth::signup');
$routes->post('/signup', 'Auth::register');

$routes->post('/logout', 'Auth::logout');

$routes->get('/forgot-password', 'Auth::forgotPassword');

$routes->group('data', function ($routes) {
    $routes->get('/', 'Data::index', ['query' => ['search_query']]);
    $routes->post('/', 'Data::create');
    $routes->get('kalurahan/(:alpha)', 'Data::kalurahan/$1',);
    $routes->get('export', 'Data::export');
    $routes->get('add', 'Data::add');
    $routes->get('(:num)', 'Data::detail/$1');
    $routes->put('(:num)', 'Data::update/$1');
    $routes->delete('(:num)', 'Data::delete/$1');
});

$routes->get('/webgis', 'WebGIS::index');

$routes->get('/diagram', 'Diagram::index');

$routes->group('users', function ($routes) {
    $routes->get('/', 'User::index');
    $routes->get('(:num)', 'User::detail/$1');
    $routes->put('(:num)', 'User::update/$1');
    $routes->delete('(:num)', 'User::delete/$1');
});
