<?php

$client = [];

 
for ($i = 0; $i < 20; $i ++) {
    $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_);
    $res = $client->connect('127.0.0.1', 9501, 0.5, 0);
    if (!$res) {
        echo "Connect Server fial.errCode = " . $client->errCode;
    } else {
        $client->send("HELLO WORLD \n");
    }
}

while (!empty($clients)) {
    $write = $error = [];
    $read = array_values($clients);
    $n = swoole_client_select($read, $write, $error, 0.6);
    if ($n > 0) {
        foreach ($read as $index => $c) {
            echo "Recv #{$c->sock}: " . $c->recv() . "\n";
            unset($clients[$c->sock]);
        }
    }
}
