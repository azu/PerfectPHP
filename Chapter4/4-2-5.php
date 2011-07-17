<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 17:57
 */
 

$ary = array(
    "日本語",
    '"!#%$&',
    '</>'
);

$escaped = array_map(function($value){
        return htmlspecialchars($value, ENT_QUOTES);
},$ary);
var_dump($escaped);

$my_pow = function($times = 2)
{
    // timesがクロージャーとして生きる
    return function($val) use (&$times)
    {
        return pow($val, $times);
    };
};
$cube = $my_pow(3);
echo $cube(5), PHP_EOL;