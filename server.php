<?php



$link_conf = [
    'host' => 'localhost',
    'user' => 'root',
    'dbname' => 'etable',
    'pwd' => ''
];

try {
    $pdo = new PDO('mysq:host=' . $link_conf['host'] . ';dbname=' . $link_conf['dbname'], $link_conf['user'], $link_conf['pwd']);
    $pdo->query("SET CHARSET 'utf8'");
} catch (PDOException $e) {
    die ('connection fail:' . $e->getMessage());
}

$sql = 'select * from message';
$stmt = $pdo->prepare($sql);
$stmt->execute();
while ($result = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    print_r($result);
}
