<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 11:53
 */

class Employee{
    public $name;
    private $state = '働いている';
    public static $company = 'none';// インスタンス化しなくてもアクセスできる

    public function getCompany(){
        return self::$company;// Employee::$company と同じ
    }
    public function getState(){
        return $this->state;// $thisはインスタンス化されたときに定義される
    }
    public function setState($state){
        $this->state = $state;
    }
    public function work(){
        echo $this->name,'は',$this->state,'している',PHP_EOL;
        
    }
}

$yamada = new Employee();
$yamada->name = "山田さん";
$yamada->setState('休憩中');
$yamada->work();

echo Employee::$company, PHP_EOL;