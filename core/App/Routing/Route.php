<?php

namespace Core\App\Routing;

use Core\App\Http\Request;

class Route
{
    public $action;
    public $controller;
    public $parameters;

    protected $route;
    protected $verb;
    protected $urn;

    public function __construct(string $route, string $controller, string $action, string $verb)
    {
        $this->action     = $action;
        $this->controller = $controller;
        $this->verb       = $verb;
        $this->parameters = [];

        $this->route = $this->explode($route); //Endereco de Rotas
        $this->urn   = $this->explode(Request::urn()); //Endereço de Entrada
    }

    public function match(): bool
    {
        if (count($this->urn) !== count($this->route)) {
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
        if ($this->urn[$position] === $piece) {
            return true;
        }

        if (strpos($piece, '{') === 0) {
            $this->parameters[] = $this->urn[$position];
            return true;
        }

        return false;
    }

    private function explode(string $urn)
    {
        if(strpos($urn, '/') === 0) {
            $urn = substr($urn, 1);
        }

        $len = strlen($urn)-1;

        if($len !== -1 && $urn[$len] === '/') {
            $urn = substr($urn, 0, $len);
        }

        return explode('/', $urn);
    }

}