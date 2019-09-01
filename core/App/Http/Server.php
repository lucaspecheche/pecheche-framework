<?php

namespace Core\App\Http;

class Server
{
    public function getHost(): ?string
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getContentType(): ?string
    {
        return $_SERVER['HTTP_CONTENT_TYPE'] ?? '';
    }

    public function getRemoteAddr(): ?string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function getMethod(): ?string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getScheme(): ?string
    {
        return $_SERVER['REQUEST_SCHEME'];
    }

    public function getUri(): ?string
    {
        return strtok($_SERVER["REQUEST_URI"],'?');
    }
}