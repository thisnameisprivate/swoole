<?php

$http = new \swoole_http_server('127.0.0.1', 2100);
$http->on('start', function ($server) {
    echo "Swoole http server is started at http://127.0.0.1\n";
});
$http->on('request', function ($request, $response) {
    $response->header("Content-type", "text/plain");
    $response->send("Hello, world.\n");
});
$http->start();
