#3章　型と演算子
#3.1　型
##3.1.1　PHPの型
##3.1.2　整数

unsignedな整数はない。
また、intの限界を超えるとfloatに自動変換される。

    echo PHP_INT_MAX, PHP_EOL; // INTの最大値
    echo PHP_INT_MAX+1, PHP_EOL; // 最大値を超えるとfloatになる
    echo (int)"123", PHP_EOL; // intへキャスト
    /*
    9223372036854775807
    9.2233720368548E+18
    123
     */

##3.1.3　浮動小数点
floatと書かれるが、実はdoubleや!!

##3.1.4　文字列
文字列はPHPの要。
勝手にキャストされたりして、文字列になるのはよくあること。

    $str = "文字列";
    echo "string $str ¥n", PHP_EOL; // ""で囲むといみがある
    echo 'string $str ¥n', PHP_EOL; // ’’だと変数などは展開されない

    echo "${str}という感じで、変数の前後にスペースはいらなくなる",PHP_EOL;

    echo <<<EOI
    ヒアドキュメントも${str}は展開する
    逆に¥n ¥tエスケープ文字列は展開されない
    変数は ¥$str でエスケープできる
    EOI;

    echo <<<'EOI'
    こういうのをNowdocという。
    中身をパースしないため、変数の展開などを行わない
    $str としてもそのままになる。
    なので、constとかにも指定できるらしいな
    (Heredocでも変数が含まれない、エスケープされてるなら問題ない)

    EOI;

    // PHPはechoなど文字列に勝手にキャストするので、浮動小数点を出力するには
    printf("%0.1f", 25.0);

引数なども文字列として渡されるので、明示的にキャストしてから
厳密比較演算子を使って比較を行うようにしてバグを減らすようにするべし。

##コラム　比較演算を行う場合の注意点
##3.1.5　論理型
PHPでfalsyなものは

- false
- 0
- 0.0
- "" , "0" 空文字列
- 要素がゼロの配列
- null -> 0
- 空タグから生成されたSimpleXMLオブジェクト

##3.1.6　配列
##3.1.7　オブジェクト
##3.1.8　リソース
mysqlとかファイルとか外部リソースへの参照を持っている型のこと

これらは外部リソースのためのものなので、キャストを行って変換できない。

##3.1.9　null
nullにするには
- 定数nullの代入
- 値がまだ入ってない変数
- unset()したもの

nullの代入とunsetは微妙に異なる。

    $var = 1;
    $var = null;// nullの代入

    // nullかどうかはissetを使う
    var_dump(isset($var));// false
    var_dump($var);// NULLとでるだけ
    // unsetをする
    unset($var);
    var_dump(isset($var));
    var_dump($var);// こっちもNULLだけど、PHP Noticeがでる(未定義の変数が使われたと同義)

##3.1.10　型変換
PHPの自動型変換の罠

    if('0.0' == '0'){
        echo "true.一緒だね…", PHP_EOL;
    }

+ '0.0'は数値っぽいの浮動小数点になる
+ '0'が数値っぽいの整数型にキャストされる
+ 浮動小数点 == 整数型 なので、浮動小数点合わせる
+ 0.0 == 0.0 なのでtrueになる

まあこういうのがあるため、厳密比較演算をして。

#3.2　演算子
##3.2.1　PHPの演算子
文字列の結合はドット演算子を使う

    $age = 15;
    echo 'Tom is ' . $age . ' years old',PHP_EOL;
    echo 'Tom is ' . 16 . ' years old',PHP_EOL;

###論理比較演算子

    // 変数がないとNULLなので、issetを使って短絡評価する
    if (isset($argv[1]) && $argv[1]) {
        echo '引数は真である', PHP_EOL;
    }
##3.2.2　三項演算子
PHPには三項演算子の省略記法(5.3)、左結合の罠

    function dosomething(){
        $val = true;
        return $val;
    }

    $res = dosomething() ? : 'def';
    echo $res, PHP_EOL;

    $flag1 = true;
    $flag2 = false;
    echo $flag1 ? 1 : $flag2 ? 2 : 0;//1ではなく2がくる
    echo ($flag1 ? 1 : $flag2) ? 2 : 0;//左結合の罠

##3.2.3　演算子の優先順位
##3.2.4　その他の演算子
＠演算子は式の警告を抑制する。

＞$var = @$_GET["test"];// PHP NOTICEが抑制される

###実行演算子
バッククオートでシェルコマンドとして実行できる

>‘grep php *‘

危険すぎや…
IEのバッククオートの誤認とか思い出す
#3.3　配列
##3.3.1　PHPの配列
##3.3.2　配列の初期化
配列はarray


    $ary = array(
        'apple',
        'ban',
        'soft'
    );
    var_dump($ary);

ちょっと特殊な[]というやつで初期化や追加ができてしまう。

    $ary_first[] = "apple";// 配列として初期化
    $ary_first[] = "ban";// [] = で配列に追加
    $ary_first[] = "peelk";
    var_dump($ary_first);
##3.3.3　連想配列
key=>valueで指定


    $flutes_color = array(
        'apple' => 'red',
        'banna' => 'yellow',
        'foo'
    );
    // 混在もできる
##3.3.4　多次元配列
array中にarrayを入れられる

    $flutes_color = array(
        'apple' =>  array(
            'apple' => 'red',
        ),
        'banna' => 'yellow',
        'foo'
    );
##3.3.5　PHPの配列の特徴のまとめ

- 添字配列と連想配列は同じ配列型
- 両者は混ぜて使える
- 連想配列は入力順が保証されている順序付きマップ

##3.3.6　配列の演算

PHPは配列同士の演算もある

- + 配列の結合(追記)
- ==配列の比較(key=valueならtrue)
- ===配列の比較(key=value と並び順、型が一致ならtrue)

上のを確認するコード

    $a = array(
        'a' => 1,
        'b' => 3,
        'c' => 5,
    );
    $b = array(
        'a' => 1,
        'c' => 5,
        'b' => 3,
    );
    $c = array(
        'a' => 1,
        'b' => 2,
    );
    echo '$a == $b ';
    var_dump($a == $b);// true
    echo '$a === $b ';
    var_dump($a === $b);// 順序が異なるのでfalse

    var_dump($a + $c);// 結合というよりは穴埋めの追記
    var_dump($c + $a);// 左側が優先なので、書き方で意味は変わる
    var_dump(array_merge($a, $c));// こっちは$cの値で上書きする

##配列のキーの有無を調べる

keyを見たい場合はarray_key_existsを使う
valueをみたい場合はisset(ary[idx])を使う。
