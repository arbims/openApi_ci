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
});

$routes->get('/swagger_json', 'SwaggerDocController::swagger');
$routes->get('/api/doc', 'SwaggerDocController::index');
