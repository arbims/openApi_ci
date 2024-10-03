<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/api/login', 'AuthController::login');
$routes->get('/api/users', 'UsersController::index');
$routes->get('/api/test', 'UsersController::test');
$routes->get('/swagger_json', 'SwaggerDocController::swagger');
$routes->get('/api/doc', 'SwaggerDocController::index');
