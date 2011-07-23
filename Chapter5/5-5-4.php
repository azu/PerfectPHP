<?php
/**
 * User: azu
 * Date: 11/07/23
 * Time: 22:22
 */
 

set_error_handler(function($errno, $errstr, $errfile, $errline){
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});