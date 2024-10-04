<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/api/login', 'AuthController::login');
$routes->group('api', ['filter' => 'authFilter'], static function ($routes) {
    $routes->get('users', 'UsersController::index');
    $routes->get('test', 'UsersController::test');
    
    $routes->get('categories', 'CategoriesController::index');
    $routes->post('categories', 'CategoriesController::create');
    $routes->put('categories/(:segment)', 'CategoriesController::update/$1');
    $routes->delete('categories/(:segment)', 'CategoriesController::delete/$1');
});

$routes->get('/swagger_json', 'SwaggerDocController::swagger');
$routes->get('/api/doc', 'SwaggerDocController::index');
