<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UsersController::index');
$routes->get('swagger.json', 'SwaggerDocController::index');
$routes->get('swagger', 'SwaggerDocController::index');
