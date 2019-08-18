<?php

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

function debug()
{

    $debug_arr = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    $line = $debug_arr[0]['line'];
    $file = $debug_arr[0]['file'];

    header('Content-Type: text/plain');

    echo "linha: $line\n";
    echo "arquivo: $file\n\n";
    print_r(array('GET' => $_GET, 'POST' => $_POST, 'SERVER' => $_SERVER));
    exit;
}