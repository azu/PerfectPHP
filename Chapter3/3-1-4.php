<?php
/**
 * User: azu
 * Date: 11/07/17
 * Time: 0:00
 */

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

