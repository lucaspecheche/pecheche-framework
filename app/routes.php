<?php

use App\Controllers\UserController;
use Core\App\Routing\Routes;

$routes = new Routes();

$routes->get('/', UserController::class, 'create');

return $routes;