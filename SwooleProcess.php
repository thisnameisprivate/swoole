<?php

$process = new swoole_process(function (swoole_process $worker) {
    echo "Worker : start. PID = " . $worker->pid . "\n";
    sleep(2);
    $worker->write("Hello, master \n");
    $worker->exit(0);
}, false);


$pid = $process->start();
$r = [$process];
$write = $error = [];
$ret = swoole_select($r, $write, $error, 1.0); // swoole_select is swoole_client_select 别名
var_dump($ret);
var_dump($process->read());
