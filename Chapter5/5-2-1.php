<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 17:12
 */
 

interface Reader{
    public function read();
}
interface Writer{
    public function write($value);
}
class Configure implements Reader,Writer{
    public function read(){

    }
    public function write($value)
    {

    }
}
