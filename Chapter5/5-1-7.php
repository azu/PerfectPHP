<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 16:44
 */

include_once('5-1-2.php');

class Programmer extends Employee{
    // 引数は同じでないといけない
    public function work(){
        echo 'プログラマを書いています',PHP_EOL;
    }
    public final function notOverwirite(){
        
    }
}
