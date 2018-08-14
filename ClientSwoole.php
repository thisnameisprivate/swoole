<?php


$server = new Swoole\Http\Server("localhost", 9502, SWOOLE_BASE);

$server->set([
    'worker_num' => 1,
]);

$server->on('Request', function ($request, $response) {

    $tcpclient = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    $tcpclient->connect("localhost", 9501, 0.5);
    $tcpclient->send("Hello, Swolle.");

    $redis = new Swolle\Coroutine\Redis();
    $redis->connect('localhost', 6379);
    $redis->setDefer();
    $redis->get('key');

    $mysql = new Swoole\Coroutine\MySQL();
    $mysql->connect([
        'host' => 'localhost',
        'user' => 'user',
        'password' => 'pass',
        'database' => 'test'
    ]);

    $mysql->setDefer();
    $mysql->query('select sleep(1)');


    $httpclient = new Swoole\Coroutine\Http\Client('0.0.0.0', 9599);
    $httpclient->setHeaders(['Host' => 'api.mp.qq.com']);
    $httpclient->set(['timeout' => 1]);
    $httpclient->setDefer();
    $httpclient->get('/');


    $tcp_res = $tcpclient->recv();
    $redis_res = $redis->recv();
    $mysql_res = $mysql->recv();
    $http_res = $http->recv();

    $response->end('Test end');

});

$server->start();
