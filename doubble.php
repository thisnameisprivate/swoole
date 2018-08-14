<?php
/**
 * bubble Sort.
 * User: kexin
 * Date: 2018/7/18
 * Time: 11:13
 */


$arr = [9, 8, 7, 5, 6, 2, 1];
$result = bubbleSort($arr);
var_dump($result);

function bubbleSort ($arr)
{
    $arrlen = count($arr);
    for ($i = 0; $i < $arrlen; $i ++) {
        for ($j = 0; $j < $arrlen - 1; $j ++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $item = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $item;
            }
        }
    }

    return $arr;
}