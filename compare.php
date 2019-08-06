<?php
// DateTime::diff と date_diffの速度差を比較してみる
// @see https://www.php.net/manual/ja/datetime.diff.php
// オブジェクト型の方がインスタンス生成コストがあるから遅くなると予測
// => 手続き型はオブジェクト型のエイリアスだから変わらない速度乙...orz


/*
 * 手続き型
 */
// 元になるメモリ使用量と開始時刻を取得
echo "手続き型\n";
$baseMemoryUsage = memory_get_usage();
$baseTime = microtime(true);

// ここに計測したい処理を書く
$datetime1 = date_create('2019-08-06 16:27:21');
$datetime2 = date_create('2020-07-24 08:00:00');
$interval = date_diff($datetime1, $datetime2);
echo $interval->format('%R%a days %H hour %I minutes %S seconds');
echo PHP_EOL;

// 処理終了後に最大メモリ使用量と終了時刻を取得
$maxMemoryUsage = (memory_get_peak_usage() - $baseMemoryUsage) / (1024 * 1024);
$processTime = microtime(true) - $baseTime;

// 計測結果を出力する
printf("Max Memory Usage : %.3f [MB]\n", $maxMemoryUsage);
printf("Process Time : %.2f [s]\n", $processTime);


// 変数を破棄
unset($baseMemoryUsage);
unset($baseTime);
unset($datetime1);
unset($datetime2);
unset($interval);
unset($maxMemoryUsage);
unset($processTime);


/*
 * オブジェクト指向型
 */
// 元になるメモリ使用量と開始時刻を取得
echo "オブジェクト指向型\n";
$baseMemoryUsage = memory_get_usage();
$baseTime = microtime(true);

// ここに計測したい処理を書く
$datetime1 = new DateTime('2019-08-06 16:27:21');
$datetime2 = new DateTime('2020-07-24 08:00:00');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%a days %H hour %I minutes %S seconds');
echo PHP_EOL;

// 処理終了後に最大メモリ使用量と終了時刻を取得
$maxMemoryUsage = (memory_get_peak_usage() - $baseMemoryUsage) / (1024 * 1024);
$processTime = microtime(true) - $baseTime;

// 計測結果を出力する
printf("Max Memory Usage : %.3f [MB]\n", $maxMemoryUsage);
printf("Process Time : %.2f [s]\n", $processTime);
echo PHP_EOL;
