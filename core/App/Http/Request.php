<?php

namespace Core\App\Http;

class Request extends ServerRequest
{
    protected $server;
    protected $input;

    public function __construct()
    {
        $this->input  = $this->load();
        parent::__construct();
    }

    private function load(): object
    {
        $input = new \stdClass();
        $data  = $this->getInput();

        foreach ($data as $key => $value) {
            @$input->$key = $value;
        }

        return $input;
    }

    private function getInput(): array
    {
        if ($this->getContentType() === Headers::APPLICATION_JSON) {
            $json = file_get_contents("php://input");
            return json_decode($json, true) ?? [];
        }

        return $_REQUEST;
    }

    public function all(): object
    {
        return $this->input;
    }

}