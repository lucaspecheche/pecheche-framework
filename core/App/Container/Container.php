<?php

namespace Core\App\Container;

class Container
{
    public static function instance(string $controller, string $action, array $parameters)
    {
        return (new $controller)->$action($parameters);
    }
}