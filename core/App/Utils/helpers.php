<?php

use Core\App\Container\Container;
use Core\App\Http\Request;
use Core\App\Http\Response;

function base_path($path = ''): string
{
    return dirname(__DIR__, 3) . "/$path";
}

function app_path($path = ''): string
{
    return base_path("app/$path");
}

function public_path($path = ''): string
{
    return base_path("public/$path");
}

function server_host($urn = ''): string
{
    $server = $_SERVER['HTTP_HOST'];
    return "http://$server/$urn";
}

function config(string $name): array
{
    return require base_path("config/$name.php");
}

function resolve(string $class)
{
    return (new Container())->resolve($class);
}

function response(): Response
{
    return resolve(Response::class);
}

function request(): Request
{
    return resolve(Request::class);
}