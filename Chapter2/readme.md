#Part 2　PHPの言語仕様

#2章　PHPの基本
#2.1　基本的な構文
##2.1.1　サンプルプログラム
＞PHP_EOL
は改行コードを表す定数
##2.1.2　PHPブロック
##2.1.3　文
##2.1.4　コメント
    # 一行コメント
    // 一行コメント
    /* 複数行コメント */
    /* 複数行コメント */
がコメント
ハッシュがあるのか。
##2.1.5　出力
##2.1.6　echo文とvar_dump()関数
##2.1.7　識別子
##2.1.8　予約語
##2.1.9　エラー

環境によって、エラーの表示が違うことがあるので、PHP側で決定できる

    // エラー出力についてPHPファイル側で設定する
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 'on');

#2.2　変数
##2.2.1　PHPの変数
##2.2.2　可変変数

変数名を使って変数にアクセスするのを可変変数というらしい。
    
    $var = 1;
    $var_name = 'var';
    echo $$var_name,PHP_EOL;// 1

##2.2.3　変数のスコープ

PHPにはブロックスコープはない。
関数レベルでスコープがあるのはJavaScriptと同じで、globalは明示的に付けないと参照できない。
> global foo
などとして参照する。
##2.2.4　定義済み変数

PHPの変数は変更不可能ではないため、定義ずみの変数でも書き換えが可能や

##2.2.5　スーパーグローバル変数
#2.3　定数
##2.3.1　定数定義
定数はdefine()関数かconstキーワードを使う。
この二つの違いは名前空間の影響の有無にある。

##2.3.2　constants()関数

定数は文字列から取得するときはconstants関数を使う。

    define("BOOK", "Perfect PHP");
    echo BOOK, PHP_EOL;

    // 文字列から定数を取得
    $var_BOOK = "BOOK";
    echo constant($var_BOOK),PHP_EOL;
    
##2.3.3　定義済み定数

定義済みな定数はget_defined_constants()で一覧が取れる

    define("BOOK", "Perfect PHP");
     // 定義済みの変数
    var_dump(get_defined_constants());
    /*
      PHP元々の定数と定義した定数がでる
      ["BOOK"]=>
      string(11) "Perfect PHP"
    */

> __FILE__

など__から始まるマジック定数というものがある。
#2.4　エラー
##2.4.1　エラーとは

エラーは大きく分けて三種類で、結構充実したエラーを吐く。
- パースエラー
- 実行時エラー
- 警告、注意

##2.4.2　エラーの種類とエラー定数

###E_PARSE
シンタックスエラーの事
###E_ERROR
実行時の致命的エラー
クラスの重複時など。
エラーが発生した時点でプログラムは終了される。
###E_WARNING

実行時に出る警告。警告はでるけど、プログラムは止まらない。

WARNIGがでた関数の結果にはNULLが帰ってくる

    // WARNIGがでて、実行結果はnullを返す
    $ret = array_reverse();
    $ret2 = array_reverse(1);

    // これも実行される
    echo "テストの終わり", PHP_EOL;
    /*テストの終わり
    PHP Warning:  array_reverse() expects at least 1 parameter, 0 given in /Users/azu/Dropbox/workspace/PHP/PerfectPHP/Chpater2/2-4-2.php on line 8
    PHP Warning:  array_reverse() expects parameter 1 to be array, integer given in /Users/azu/Dropbox/workspace/PHP/PerfectPHP/Chpater2/2-4-2.php on line 9
    */

###E_NOTICE
初期化されてない変数を使ったりするとでる。

>echo FOO, PHP_EOL;

定義されてない定数を使おうとする

>PHP Notice:  Use of undefined constant FOO - assumed 'FOO' in

がでて、FOOという文字列が出力される。
大変謎な挙動ですね。

###E_DEPRECATED, E_STRICT
その書き方は非推奨だから直せ。
だがプログラムは止まらない

###ユーザーエラー

ユーザーエラーという例外を発生させる仕組みがある。
PHP5からは例外があるので、普通にthrowしたほうが楽そう。


##2.4.3　例外
##2.4.4　エラーに関する設定
