<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 1:27
 */
 
$a = array(
    'a' => 1,
    'b' => 3,
    'c' => 5,
);
$b = array(
    'a' => 1,
    'c' => 5,
    'b' => 3,
);
$c = array(
    'a' => 1,
    'b' => 2,
);
echo '$a == $b ';
var_dump($a == $b);// true
echo '$a === $b ';
var_dump($a === $b);// 順序が異なるのでfalse

var_dump($a + $c);// 結合というよりは穴埋めの追記
var_dump($c + $a);// 左側が優先なので、書き方で意味は変わる
var_dump(array_merge($a, $c));// こっちは$cの値で上書きする
