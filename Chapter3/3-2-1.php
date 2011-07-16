<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 0:36
 */
 
$age = 15;
echo 'Tom is ' . $age . ' years old',PHP_EOL;
echo 'Tom is ' . 16 . ' years old',PHP_EOL;

// 変数がないとNULLなので、issetを使って短絡評価する
if (isset($argv[1]) && $argv[1]) {
    echo '引数は真である', PHP_EOL;
}