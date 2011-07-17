<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 17:34
 */
 
function fn_caller($fnname){
    if (function_exists($fnname)) {
        $fnname();// 可変関数として呼び出し
    }
}
function foo(){
    echo "foo", PHP_EOL;
}
fn_caller('foo');

// call_user_func

function add($v1,$v2){
    return $v1 + $v2;
}
class Math {
    public function sub($v1, $v2)
    {
        return $v1 - $v2;
    }

    public static function add($v1, $v2)
    {
        return $v1 + $v2;
    }
}

call_user_func('add', 1, 2);// 3

// 無名関数の指定 => 名前付き関数は無理だった
call_user_func(function($v1,$v2){
    return $v1 + $v2;
}, 1,2);

call_user_func('Math::add', 1, 2);
// Math::addを呼ぶ -> static限定
call_user_func(array('Math','add'),1,2);
// インスタンスを指定して呼ぶ
$math = new Math();
call_user_func(array($math, 'sub'),1,2);

// function#applyみたいな
call_user_func_array('add', array(1, 2));