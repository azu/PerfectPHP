<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 20:42
 */
 
class SomeClass
{
    private $values = array();
    // getter
    public function __get($name)
    {
        echo "get : $name", PHP_EOL;
        if (!isset($this->values[$name])) {
            throw new OutOfBoundsException($name . 'not found.');
        }
        return $this->values[$name];
    }
    // setter
    public function __set($name, $value)
    {
        echo "set : $name setted to $value",PHP_EOL;
        $this->values[$name] = $value;
    }
    // isset
    public function __isset($name)
    {
        echo "isset: $name" ,PHP_EOL;
        return isset($this->values[$name]);
    }
    // unset
    public function __unset($name)
    {
        echo "unset: $name" ,PHP_EOL;
        unset($this->values[$name]);
    }

    // __call - アクセスできないメソッドを呼び出したときに呼ばれる
    public function __call($name, $args)
    {
        echo "call:$name" ,PHP_EOL;
        // アンダースコアをつけてメソッド名に
        $method_name = '_' . $name;
        if (!is_callable(array($this, $method_name))) {
            throw new BadMethodCallException($name . 'method not found.');
        }
        return call_user_func_array(array($this, $method_name),$args);
    }
    // __callStatic - アクセスできないstaticメソッドを呼びしたときに呼ばれる
    public static function __callStatic($name, $args)
    {
        echo "callStatic: $name" ,PHP_EOL;
        // アンダースコアをつけてメソッド名に
        $method_name = '_' . $name;
        // staticの場合は$thisではなくselfキーワード
        if (!is_callable(array('self', $method_name))) {
            throw new BadMethodCallException($name . 'method not found.');
        }
        return call_user_func_array(array('self', $method_name), $args);

    }

    // テスト用 - privateなのでなので、外からは呼べない
    private function _bar($value)
    {
        echo "bar called with arg $value", PHP_EOL;
    }
    private static function _staticBar($value)
    {
        echo "staticbar called with arg $value" ,PHP_EOL;
    }
}

$obj = new SomeClass();
$obj->foo = 10;
isset($obj->foo);
echo 'empty',PHP_EOL;
empty($obj->foo);// isset -> getの順で呼ばれてる
echo 'call_' ,PHP_EOL;
$obj->bar('baz');// _barが呼ばれる
SomeClass::staticBar('bazz');// _staticBarが呼ばれる