<?php

require_once __DIR__ . '/Utils/helpers.php';

$routes = require app_path('routes.php');
$routes->demand();