<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 22:30
 */
 
$a = 10;
$b = &$a; // 参照のコピー
$c = $a;// 値のコピー

$b = 20;
var_dump($a);//20