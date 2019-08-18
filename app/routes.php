<?php

use App\Controllers\UserController;
use Core\App\Routing\Routes;

$routes = new Routes();

$routes->get('/users/list/{id}', UserController::class, 'create');
$routes->get('/', UserController::class, 'create');

return $routes;