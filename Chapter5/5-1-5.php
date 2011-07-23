<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 16:21
 */

class Employee{
    private static $company = "none";
    public static function getCompany(){
        //staticメソッド内は$thisを使えない。
        return self::$company;
    }
    public static function setCompany($company){
        self::$company = $company;
    }
}

echo Employee::getCompany(), PHP_EOL;
Employee::setCompany('gihyo');
echo Employee::getCompany(), PHP_EOL;