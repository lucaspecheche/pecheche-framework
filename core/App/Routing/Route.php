<?php

namespace Core\App\Routing;

use Core\App\Http\Request;

class Route
{
    public $action;
    public $controller;
    public $parameters;

    protected $request;
    protected $route;
    protected $verb;
    protected $uri;

    public function __construct(string $route, string $controller, string $action, string $verb)
    {
        $this->action     = $action;
        $this->controller = $controller;
        $this->verb       = $verb;
        $this->parameters = [];

        $this->request    = new Request();

        $this->route = $this->explode($route); //Endereco de Rotas
        $this->uri   = $this->explode($this->request->getUri()); //Endereço de Entrada
    }

    public function match(): bool
    {
        if (count($this->uri) !== count($this->route)) {
            return false;
        }

        if ($this->verb !== $this->request->getMethod()) {
            return false;
        }

        foreach ($this->route as $key => $piece) {
           $validation = $this->validatePiece($key, $piece);

           if($validation === false) {
              return false;
           }
        }

        return true;
    }

    private function validatePiece(int $position, string $piece): bool
    {
        if ($this->uri[$position] === $piece) {
            return true;
        }

        if (strpos($piece, '{') === 0) {
            $this->parameters[] = $this->uri[$position];
            return true;
        }

        return false;
    }

    private function explode(string $uri)
    {
        if(strpos($uri, '/') === 0) {
            $uri = substr($uri, 1);
        }

        $len = strlen($uri)-1;

        if($len !== -1 && $uri[$len] === '/') {
            $uri = substr($uri, 0, $len);
        }

        return explode('/', $uri);
    }

}