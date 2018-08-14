<?php


$server = new swoole_http_server('127.0.0.1', 9503);
$server->on('connect', function ($server, $fd) {
    echo "Connection open:{$fd}\n";
});
$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Swoole: {$data}");
    $server->close($fd);
});
$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd} \n";
});

$server->start();
