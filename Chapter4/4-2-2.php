<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 17:23
 */

function myabs($num){
    if ($num < 0) {
        return -$num;
    }
    return $num;
}

function hello($name, $greeting = 'こんにちわ')
{

    echo $greeting," ", $name, PHP_EOL;
}

hello('mimi');
hello('nene', "Hellow");


// タイプヒンティング
function array_output(array $var){
    foreach($var as $i){
        echo $i, PHP_EOL;
    }
}

array_output(array(1, 2, 3));
array_output(1);// 型がちがう
