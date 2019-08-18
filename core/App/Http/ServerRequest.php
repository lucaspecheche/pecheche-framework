<?php

namespace Core\App\Http;

class ServerRequest
{
    private $server;

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function getHost(): ?string
    {
        return $this->server['HTTP_HOST'];
    }

    public function getContentType(): ?string
    {
        return $this->server['HTTP_CONTENT_TYPE'];
    }

    public function getRemoteAddr(): ?string
    {
        return $this->server['REMOTE_ADDR'];
    }

    public function getMethod(): ?string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getScheme(): ?string
    {
        return $this->server['REQUEST_SCHEME'];
    }

    public function getUri(): ?string
    {
        return $this->server['REQUEST_URI'];
    }

    public function getUrn(): ?string
    {
        return parse_url($this->getUri(), PHP_URL_PATH);
    }

}