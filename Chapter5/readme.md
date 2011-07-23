
#5章　クラスとオブジェクト
#5.1　クラス
##5.1.1　PHPのクラス
##5.1.2　クラスの定義
##5.1.3　プロパティ
###$this
クラスをインスタンス化したときに$thisが定義され、$thisは自分自身(インスタンスオブジェクト)
を示す。

    class Employee{
        public $name;
        private $state = '働いている';
        public function getState(){
            return $this->state;// $thisはインスタンス化されたときに定義される
        }

        public function setState($state){
            $this->state = $state;
        }
        public function work(){
            echo $this->name,'は',$this->state,'している',PHP_EOL;

        }
    }

    $yamada = new Employee();
    $yamada->name = "山田さん";
    $yamada->setState('休憩中');
    $yamada->work();

またPHPは以下のようにインスタンスオブジェクトから存在しないプロパティを定義しでもエラーなく動作する。

>$yamada->job='プログラマ';

この時jobはpublicになる

###staticプロパティ

>public static $company = 'none';// インスタンス化しなくてもアクセスできる

というようにクラス内でstaticプロパティを宣言すると、インスタンス化しなくてもアクセスできる。
アクセスするときはクラス名::プロパティ名 でアクセスできる。

シングルトンなどで便利に使える。

> echo Employee::$company, PHP_EOL;

###self
selfはクラス自身を示すキーワード

staticなどクラス自体について触れるときに使える。
self::変数 という感じで記述するので変数は$companyのように通常の変数と同じように書くのに気をつける。

    public static $company = 'none';// インスタンス化しなくてもアクセスできる

    public function getCompany(){
        return self::$company;// Employee::$company と同じ
    }

##5.1.4　定数
constキーワードはスカラー値のみに使えて、配列などは無理

    class Employee{
        const PARTTIME = 0x01;
        const REGULAR = 0x02;
    }
    echo Employee::REGULAR, PHP_EOL;// 2

constキーワードで宣言した変数はstaticと同じようにクラスからアクセスできる変数になる。

##5.1.5　メソッド
###staticメソッド
変数と似に多様な感じで、staticなクラスメソッドを定義できる。

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
##5.1.6　コンストラクタとデストラクタ
マジックメソッドという言われるものの一つで__から始まるメソッド

デストラクタはどの変数からも参照されなくなった際に呼ばれるので、開放などについて記述するはず

    class Employee{
        // コンストラクタで設定する
        private $name;
        private $type;
        public function __construct($name,$type){
            $this->name = $name;
            $this->type = $type;
        }
        // デストラクタ
        public function __destruct(){

        }
    }
    new Employee('名前','タイプ');

##コラム　PHP 4とPHP 5のコンストラクタ
##5.1.7　継承
###オーバーライド

    include_once('5-1-2.php');

    class Programmer extends Employee{
        // 引数は同じでないといけない
        public function work(){
            echo 'プログラマを書いています',PHP_EOL;
        }
    }

###parent
parentキーワードは継承した子クラスから親クラスを表すキーワード
superみたいな、親の処理を呼ぶのに使える

###final
finalキーワードをつけたものは、オーバーライドできなくなる。

    public final function notOverwirite(){

    }

##5.1.8　標準クラスとキャスト
PHPにはstdClassという空のクラスが用意されている。

    // 空のクラスを初期化
    $obj = new stdClass();
    $obj->some_member = 1;

##5.1.9　抽象クラス
abstractで抽象クラスが作れる

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
#5.2　インターフェイス
interfaceで宣言して、implementで実装する。

PHPには定義済みのインターフェイスもある。

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

抽象クラス、インターフェイス両方共、実装されていないとエラーになります。

２つの使い分けについて。

- [PHPのinterfaceとabstractを正しく理解して使い分けたいぞー ::ハブろぐ](http://havelog.ayumusato.com/develop/php/e166-php-interface-abstract.html "PHPのinterfaceとabstractを正しく理解して使い分けたいぞー ::ハブろぐ")

##5.2.1　インターフェイスの定義と実装
##5.2.2　定義済みインターフェイス
##5.2.3　インターフェイスのチェック
PHPのインターフェイスは引数の型を保証してくれるわけではない。
###タイプヒディング
タイプヒディングで引数の型を指定する

    public function bar(Iterator $itr){
    }

###型演算子
実装時にinstanceof(型演算子)を使って、引数が特定の型なのか判定する


これらの方法で、インターフェイスを補う。

#5.3　クラスとオブジェクトの機能と特徴
##5.3.1　マジックメソッド
マジックメソッドは特定ノ条件で自動的に呼び出されるメソッドの事。
マジックメソッドはpublicで宣言する必要がある

- [PHP: マジックメソッド - Manual](http://php.net/manual/ja/language.oop5.magic.php "PHP: マジックメソッド - Manual")

###オーバーロード
__getや__setなどをオーバーロードとして定義することで、代わりに呼び出すようになる。
以下は、呼び出す前にメッセージを出すようにしたものと、privateなどアクセスできないメソッドに
アクセス使用としている際に、‘__noSuchMethod__‘みたいに代わりにprivateを呼び出すような仕組み


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

- [PHP: オーバーロード - Manual](http://php.net/manual/ja/language.oop5.overloading.php "PHP: オーバーロード - Manual")


##5.3.2　遅延性的束縛
self::と書かれたメソッドがあるクラスを継承したクラスから呼び出すと、
self::は継承元のクラス(親クラス)を示してしまうという問題。

その場合にstatic::を使えば、継承元のクラスを示せるよって話。

- <a href="http://blog.justoneplanet.info/2010/11/28/php5-3%E3%81%AE%E9%81%85%E5%BB%B6%E9%9D%99%E7%9A%84%E6%9D%9F%E7%B8%9B%E3%82%92%E4%BD%BF%E3%81%A3%E3%81%A6%E3%81%BF%E3%82%8B/">PHP5.3の遅延静的束縛を使ってみる - @blog.justoneplanet.info</a>

##5.3.3　オートロード

- __autoload
- spl_autoload_register

を使えば、クラスを記述したファイルを先に読んでおかなくても、
そのクラスを呼び出したときに探索して読み込むことができる。

非同期でモジュールをロードするみたいな話

#5.4　名前空間
PHP5.3から名前空間が導入された
##5.4.1　PHPの名前空間
ディレクトリのようなもので、namespaceで名前空間を定義する。
区切り文字はバックスラッシュ¥

    // Cake.php
    // 名前空間
    namespace Food¥Sweets;
    // 次のnamespaceが出てくるまで名前空間が適応される
    class Cake{

    }

呼び出すときに同じように区切り文字¥で書く。

    require_once 'Cake.php';
    $c = new Food¥Sweets\Cake();

##5.4.2　名前空間の定義
> namespace 名前空間;

が基本形で、¥で階層化できるので
> namespace 名前空間¥サブ名前空間

という感じになる。

名前空間の影響をうけるのは

- クラス
- 関数
- 定数(constのみ)

なので、通常の変数やdefineの定数は名前空間の影響を受けない。

一つのファイル内で複数の生空間を定義するときは{}で囲むとわかりやすい。

    namespace Project¥Module{

    // ここは　Project¥Module の名前空間

        class Directory{

        }

    }

    namespace Project¥Module2{

        //ここは　Project¥Module2 の名前空間
        // Project¥Module2¥Directory
        class Directory{

        }

    }
##5.4.3　インポートルール
>use 名前空間 as 別名;

>use Project¥Module2;// use Project¥Module2 as Module2;と同じ

##5.4.4　名前解決
まあこれは頑張れ
#5.5　例外
PHP5から入った噂の例外
##5.5.1　PHPの例外
##5.5.2　定義済みの例外
Exceptionが例外の基底クラス。拡張するときはこれを継承する。
##5.5.3　例外の拡張
##5.5.4　PHPのエラーと例外
昔は例外なくてエラー通知だったので、error_handlerを設定して、例外を投げるようにするということも。

    set_error_handler(function($errno, $errstr, $errfile, $errline){
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });

エラーと例外、どっち使うかは統一しましょう。
#5.6　参照
##5.6.1　参照とは
スカラー値の代入はそのままな感じ

    $a = 10;
    $b = &$a; // 参照のコピー
    $c = $a;// 値のコピー

    $b = 20;
    var_dump($a);//20

###配列の参照
ちょっとややこしいけど、array($a,$b)の時点でコピーされていることに気づけばいい。

    function array_pass($array)
    {
        $array[0] *= 2;
        $array[1] *= 2;
    }

    function array_pass_ref(&$array)
    {
        $array[0] *= 2;
        $array[1] *= 2;
    }

    $a = 10;
    $b = 20;
    $array = array($a, $b); // ここで$a,$bの内容はコピーされてる
    array_pass_ref($array);
    var_dump($array); // こっちは参照によって書き換えされている
    echo $a . ' ' . $b, PHP_EOL; // 10 20のまま

    $array_ref = array(&$a, &$b);
    array_pass($array_ref);
    echo $a . ' ' . $b, PHP_EOL;// 20, 40になる
###オブジェクトの参照
new演算子によってオブジェクトをインスタンス化したときは参照になっています。

コピーにしたい場合はcloneを使う必要がある。

> $yamada = clone Employee();

図5.6面白いからよく見る。

##5.6.2　参照変数の扱い
##5.6.3　オブジェクトの参照
##コラム　PHP 4のオブジェクトの参照
##5.6.4　リファレンスカウントとオブジェクトの寿命
##5.6.5　変数のリファレンスとコピーオンライト
PHPでは変数を値渡しした際にもコピーオンライトという仕組みが使われているため、
内部的に参照として扱われてることもある。

    $a = 1;
    $b = $a;// 実は参照してる
    $b = 2;// 参照をやめる

コピーオンライトは値が変更されるまでは同じものを参照して、メモリを節約する動作。
