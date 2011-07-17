<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 16:57
 */
$ary = array(1, 2, 3, 4, 5, 6);
// この時$valueへコピーされる
foreach ($ary as $value) {
    echo $value, PHP_EOL;
}
echo "foreachの外 " . $value,PHP_EOL;// ブロックスコープではない
// 配列のキーも行ける
$fluites_color = array(
    'apple' => 'red',
    'banna' => 'yellow',
    'orange' => 'orange'
);
foreach($fluites_color as $name => $color){
    echo $name . ' is ' . $color, PHP_EOL;
    
}

// 参照を得ることができる -> $colorはコピーではない
foreach($fluites_color as &$color){
    $color .= ' s';
}
var_dump($fluites_color);// fluitesが全部書き換わる
unset($color);// 最後のcolorは参照持ったままなので解除する