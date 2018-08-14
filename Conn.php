<?php
/**
 * Created by PhpStorm.
 * User: kexin
 * Date: 2018/7/18
 * Time: 10:33
 */


$link_conf = [
    'host'=> 'localhost',
    'user' => 'root',
    'dbname' => 'xhyy',
    'pwd' => ''
];


try {
    $service_pdo = new PDO('mysql:host=' . $link_conf['host'] . ';dbname=' . $link_conf['dbname'], $link_conf['user'], $link_conf['pwd']);
    $service_pdo->query("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die ("Connection fail: " . $e->getMessage());
}

$sql = "SELECT * FROM nk WHERE id > ?";
$stmt = $service_pdo->prepare($sql);
$id = 1;
$stmt->bindValue(1, $id);
$stmt->execute();

$re = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($re);

