<?php


$link_conf = [
    'host' => 'localhost',
    'user' => 'root',
    'dbname' => 'etable',
    'pwd' => ''
];

/*

    try {
        $pdo = new PDO('mysql:host=' . $link_conf['host'] . ';dbname=' . $link_conf['dbname'], $link_conf['user'], $link_conf['pwd']);
        $pdo->query("SET CHARSET 'utf8'");
    } catch (PDOException $e) {
        die ("connection fail:" . $e->getMessage());
    }

    $sql = 'select * from meg';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $key => $value) {
        echo "<li>" .$value['time'] .":  旧的聊天信息->>>&nbsp;&nbsp;&nbsp;&nbsp;</li>";
        echo "<br>";
        echo "<div class='bgcolor'>" .$value['msg']. "</div>";
    }

*/


try {

    $service_pdo = new PDO('mysql:host=' . $link_conf['host'] . ';dbname=' . $link_conf['dbname'], $link_conf['user'], $link_conf['pwd']);
    $pdo->query("SET CHARSET 'utf8'");

} catch (PDOException $e) {

    die ("Connection fail: " . $e->getMessage());
    
}

$sql = "select * from wechatuser where id = ? or id = ?";
$stmt = $service_pdo->prepare($sql);

$start = 1;
$end = 2;

$stmt->bindValue(1, $start);
$stmt->bindValue(2, $end);

$stmt->execute();

$re = $stmt->fetchAll(PDO::FETCH_ASSOC);
