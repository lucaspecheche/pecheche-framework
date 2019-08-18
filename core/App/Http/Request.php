<?php

namespace Core\App\Http;

class Request
{
    public static function urn()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    }

    private function getRequest()
    {
        $obj = new \stdClass();

        foreach ($_GET as $key => $value) {
            @$obj->get->$key = $value;
        }

        foreach ($_POST as $key => $value) {
            @$obj->post->$key = $value;
        }

        return $obj;
    }

}