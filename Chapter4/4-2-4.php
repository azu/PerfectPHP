<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 17:39
 */
 
function add_one(&$val)
{
    $val += 1;
}
$a = 10;
add_one($a);
echo $a, PHP_EOL;//11