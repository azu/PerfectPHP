<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 22:33
 */

function array_pass($array)
{
    $array[0] *= 2;
    $array[1] *= 2;
}

function array_pass_ref(&$array)
{
    $array[0] *= 2;
    $array[1] *= 2;
}

$a = 10;
$b = 20;
$array = array($a, $b); // ここで$a,$bの内容はコピーされてる
array_pass_ref($array);
var_dump($array); // こっちは参照によって書き換えされている
echo $a . ' ' . $b, PHP_EOL; // 10 20のまま

$array_ref = array(&$a, &$b);
array_pass($array_ref);
echo $a . ' ' . $b, PHP_EOL;// 20, 40になる