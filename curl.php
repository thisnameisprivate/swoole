<?php


header("Content-Type:text/json;charset=utf8");
$data = [
    'license' => ''
];

$data_string = json_encode($data);
$ch = $curl_string;
$url = 'http://192.168.2.77:6400';

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CUROPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Content-length:' . strlen(json_encode($data))]);

$Output = curl_exec($ch);
curl_close($ch);
$Output = htmlspecialchars_decode($Output);
$output = json_encode($Output);
var_dump();
