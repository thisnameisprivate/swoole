<?php


$server = new Swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
$client->on('connect', function (swoole_client $cli) {
    $cli->send("hello, world\n");
});

$client->on('receive', function (swoole_client $cli, $data) {
    echo "Receive: $data \n";
    $cli->send(str_repeat('A', 10). "\n");
    $cli->enableSSL(function ($client) {
        $client->send();
    });
});


$client->on('error', function (swoole_client $cli) {
    echo "error \n";
});

$client->on('close', function (swoole_client $cli) {
    echo "Connection close \n";
});

$client->connect('localhost', 9501);
