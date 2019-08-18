<?php

namespace Core\App\Routing;

use Core\App\Container\Container;

class Routes
{
    private $routes;

    public function get($uri, $controller, $action)
    {
        $this->set($uri, $controller, $action, Verbs::GET);
    }

    public function post($uri, $controller, $action)
    {
        $this->set($uri, $controller, $action, Verbs::POST);
    }

    private function set($uri, $controller, $action, $verb)
    {
        $this->routes[] = new Route(...func_get_args());
    }

    public function demand()
    {
        foreach ($this->routes as $route) {
            $exists = $route->search();

            if($exists) {
                return Container::instance($route->controller, $route->action, $route->parameters);
            }
        }

        include public_path('404/index.phtml');
        die();
    }
}