<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 0:51
 */

function dosomething()
{
    $val = true;
    return $val;
}

$res = dosomething() ? : 'def';
echo $res, PHP_EOL;

$flag1 = true;
$flag2 = false;
echo $flag1 ? 1 : $flag2 ? 2 : 0;//1ではなく2がくる
echo ($flag1 ? 1 : $flag2) ? 2 : 0;//左結合の罠