<?php


set_time_limit(0);

$ip = '127.0.0.1';
$port = 8888;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) == FALSE) {
    echo 'create fail:' . socket_strerror(socket_last_error());
}

if (socket_bind($sock, $ip, $port) == FALSE) {
    echo 'bind fail:' . socket_strerror(socket_last_error());
}

if (socket_listen($sock, 4) == FALSE) {
    echo 'listen fail:' . socket_strerror(socket_last_error());
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) == FALSE) {
        echo 'accpet fail:' . socket_strerror(socket_last_error());
        break;
    } else {
        $msg = 'server send successfully';
        socket_write($msgsock, $msg, strlen($msg));
        echo '-----test successfully-----';
        $buf = socket_read($msgsock, 8192);

        $talkback = 'receive client: ' . $buf;
        echo $talkback;
        if ($count >= 5) break;
    }
} while (true);

socket_close($sock);
