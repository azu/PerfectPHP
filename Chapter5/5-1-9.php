<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 17:00
 */

// 抽象クラスで宣言だけをする
abstract class Employee{
    abstract public function work();
}

// 実装するのは継承したクラス
class Programmer extends Employee{
    public function work(){
        // 実装を書く
    }
}