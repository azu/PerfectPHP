<?php
/**
 * User: azu
 * Date: 11/07/16
 * Time: 23:12
 */
 
define("BOOK", "Perfect PHP");
echo BOOK, PHP_EOL;

// 文字列から定数を取得
$var_BOOK = "BOOK";
echo constant($var_BOOK),PHP_EOL;