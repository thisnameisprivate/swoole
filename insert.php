<?php

$msg = $_GET['method'];

$link_conf = [
    'host' => 'localhost',
    'user' => 'root',
    'dbname' => 'etable',
    'pwd' => ''
];

try {
    $pdo = new PDO('mysql:host=' . $link_conf['host'] . ';dbname=' . $link_conf['dbname'], $link_conf['user'], $link_conf['pwd']);
    $pdo->query("SET CHARSET 'utf8'");
} catch (PDOException $e) {
    die ('connection fail:' . $e->getMessage());
}


$sql = "insert into meg (msg) value ('{$msg}')";
$result = $pdo->exec($sql);
if ($result) {
    print_r($msg);
} else {
    echo '发送消息失败。';
}
