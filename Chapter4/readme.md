#4章　制御構造と関数
#4.1　制御構造
##4.1.1　プログラムの構成要素と制御構造
##4.1.2　if-elseif-else
##4.1.3　制御構造に関する別の構文
PHPはファイル中のPHPブロックのみをソースコードとして認識する。

    <?php
    ?>
    HTML
    <?php
    ?>

このブロック間をまたぐようなコードを書いてもいい。

またブロックをまたいで書くときに、{}の代わりにif(): endif;という表現もできたりする。

    $display_message = true;
    if(isset($display_message)): ?>
    ここはHTMLなど
    <?php endif; ?>

##4.1.4　while
##4.1.5　do-while
##4.1.6　for
##4.1.7　foreach
PHPでは好んで使われる。

    $ary = array(1, 2, 3, 4, 5, 6);
    // この時$valueへコピーされる
    foreach ($ary as $value) {
        echo $value, PHP_EOL;
    }
    echo "foreachの外 " . $value,PHP_EOL;// ブロックスコープではない

連想配列のキーを見るのにも便利に使える

    // 配列のキーも行ける
    $fluites_color = array(
        'apple' => 'red',
        'banna' => 'yellow',
        'orange' => 'orange'
    );
    foreach($fluites_color as $name => $color){
        echo $name . ' is ' . $color, PHP_EOL;

    }

さらに配列の参照を得ることができて、参照元の配列を書き換えできる。
あんまり推奨されないらしいので、for文でも使うのかな。


    // 参照を得ることができる -> $colorはコピーではない
    foreach($fluites_color as &$color){
        $color .= ' s';
    }
    var_dump($fluites_color);// fluitesが全部書き換わる
    unset($color);// 最後のcolorは参照持ったままなので解除する
##4.1.8　break
##4.1.9　continue
##4.1.10　switch
switchの各caseでの比較には===演算子が使われる。
##4.1.11　return
##4.1.12　exit
##4.1.13　require／require_once
二つの違いは、同じファイルをなんども読み込めるかの違い。

requireするファイルが存在しない時もFatal errorで実行は停止する。
またrequireは読み込んだファイル内のクラスで名前が衝突したりするとFatal error
を吐いて終了してしまう。

    require_once 'SomeLib.php';
    $obj = new SomeLib();

    require 'SomeLib.php';//PHP Fatal error:

##4.1.14　include／include_once
requireと同じく外部ファイルを読み込む構文。
includeとrequireとの違いは、ファイルが存在しなかった場合にFatalエラーではなく、
Warningとして警告がでるだけど、実行は継続される点にある。


##4.1.15　goto
#4.2　関数
##4.2.1　関数の基本
##4.2.2　関数の定義
関数は重複した定義するとFaltal errorで殺される。
(absはもともとあるためエラー)

    function myabs($num){
        if ($num < 0) {
            return -$num;
        }
        return $num;
    }

関数には引数のデフォルト値を決めることができる。便利

    function hello($name, $greeting = 'こんにちわ')
    {

        echo $greeting," ", $name, PHP_EOL;
    }

    hello('mimi');
    hello('nene', "Hellow");

###タイプヒンティング
引数に渡せる型を限定できる。
型は特定のクラス名かarrayを指定する。

    // タイプヒンティング
    function array_output(array $var){
        foreach($var as $i){
            echo $i, PHP_EOL;
        }
    }

    array_output(array(1, 2, 3));
    array_output(1);// 型がちがう

##4.2.3　関数の呼び出し

###コールバック関数
文字列や無名関数などを渡して呼んでもらうやつ
###可変関数
可変変数の関数版

文字列から関数を呼び出すことができる。

    function fn_caller($fnname){
        if (function_exists($fnname)) {
            $fnname();// 可変関数として呼び出し
        }
    }
    function foo(){
        echo "foo", PHP_EOL;
    }
    fn_caller('foo');

call_user_funcとcall_user_func_arrayというjsのcallやapplyみたいなものが存在する。


    // call_user_func

    function add($v1,$v2){
        return $v1 + $v2;
    }
    class Math {
        public function sub($v1, $v2)
        {
            return $v1 - $v2;
        }

        public static function add($v1, $v2)
        {
            return $v1 + $v2;
        }
    }

    call_user_func('add', 1, 2);// 3

    // 無名関数の指定 => 名前付き関数は無理だった
    call_user_func(function($v1,$v2){
        return $v1 + $v2;
    }, 1,2);

    call_user_func('Math::add', 1, 2);
    // Math::addを呼ぶ -> static限定
    call_user_func(array('Math','add'),1,2);
    // インスタンスを指定して呼ぶ
    $math = new Math();
    call_user_func(array($math, 'sub'),1,2);

    // function#applyみたいな
    call_user_func_array('add', array(1, 2));
##4.2.4　参照による引数と返り値
引数を参照として受け取って書き換えもできる。
これは破壊的な関数と言える。

またこの時に、引数として直接値をわすとエラーになる。

    function add_one(&$val)
    {
        $val += 1;
    }
    $a = 10;
    add_one($a);
    echo $a, PHP_EOL;//11

##4.2.5　無名関数
PHP5.3から無名関数が使える

    $ary = array(
        "日本語",
        '"!#%$&',
        '</>'
    );

    $escaped = array_map(function($value){
            return htmlspecialchars($value, ENT_QUOTES);
    },$ary); // 配列が第二って何かきもい…
    var_dump($escaped);

###クロージャー
変数に無名関数を入れることもできる。
その時にuse構文を使うことで、クロージャーができる。

    $my_pow = function($times = 2)
    {
        // timesがクロージャーとして生きる
        return function($val) use (&$times)
        {
            return pow($val, $times);
        };
    };
    $cube = $my_pow(3);
    echo $cube(5), PHP_EOL;
###create_function
かつて無名関数みたいなモノを作ってたけど、今はいらない子
##4.2.6　定義済み関数
get_defined_functions関数を使う