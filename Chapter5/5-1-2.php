<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 11:29
 */
 
class Employee{
    public function work(){
        echo "仕事してます",PHP_EOL;
    }
}

$yamada = new Employee();
$yamada->work();
unset($yamada);
var_dump(isset($yamada));
