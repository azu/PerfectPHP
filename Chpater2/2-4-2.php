<?php
/**
 * User: azu
 * Date: 11/07/16
 * Time: 23:31
 */
// WARNIGがでて、実行結果はnullを返す
$ret = array_reverse();
$ret2 = array_reverse(1);
echo ($ret===NULL), ($ret2===NULL), PHP_EOL;
// これも実行される
echo "テストの終わり", PHP_EOL;
/*テストの終わり
PHP Warning:  array_reverse() expects at least 1 parameter, 0 given in /Users/azu/Dropbox/workspace/PHP/PerfectPHP/Chpater2/2-4-2.php on line 8
PHP Warning:  array_reverse() expects parameter 1 to be array, integer given in /Users/azu/Dropbox/workspace/PHP/PerfectPHP/Chpater2/2-4-2.php on line 9
*/

echo FOO, PHP_EOL;