<?php

namespace Core\App\Http;

class Response
{
    public static function json($data)
    {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode($data);
    }
}