<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 0:22
 */
 
$var = 1;
$var = null;// nullの代入

// nullかどうかはissetを使う
var_dump(isset($var));// false
var_dump($var);// NULLとでるだけ
// unsetをする
unset($var);
var_dump(isset($var));
var_dump($var);// こっちもNULLだけど、PHP Noticeがでる(未定義の変数が使われたと同義)
