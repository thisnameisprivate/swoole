<?php

error_reporting(E_ALL);
set_time_limit(0);


$ip = '127.0.0.1';
$port = 8888;

$socket = socket_create(AF_INEF, SOCK_STREAM, SOL_TCP);
if ($socket == false) {
    echo 'create fail:' . socket_strerror(socket_last_error());
} else {
    echo 'OK';
}

echo 'we will try to connect ' . $ip . ':' . $port . '\r\n---';
$result = socket_connect($socket, $ip, $port);
if ($result == false) {

}

$in = 'HO ';
$in .= 'first blood--------';
$out = '';

if (!socket_write($socket, $in, strlen($in))) {
    echo 'write fail:' . socket_strerror(socket_last_error());
} else {
    echo "-----send to server successfully! \r\n-----";
    echo 'the content is ' . $in;
}

while ($out = socket_read($socket, 8129)) {
    echo "-----receive from server successfully! \r\n------";
    echo 'the contents is '. $out;
}


echo '-----close socket-----';
socket_close($socket);
echo 'closed ok.';
