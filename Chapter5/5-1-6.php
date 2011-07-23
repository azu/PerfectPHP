<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 16:30
 */
 
class Employee{
    // コンストラクタで設定する
    private $name;
    private $type;
    public function __construct($name,$type){
        $this->name = $name;
        $this->type = $type;
    }
    // デコストラクタ
    public function __destruct(){
        
    }
}
new Employee('名前','タイプ');
