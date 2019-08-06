<?php
// PHPの使用メモリと処理時間を計測するスクリプト
// @see https://qiita.com/h13/items/a75fba76f435212a2eb3

// 元になるメモリ使用量と開始時刻を取得
$baseMemoryUsage = memory_get_usage();
$baseTime = microtime(true);

// ここに計測したい処理を書く
for ($i = 0; $i < 100; $i++) {
    $data = range(1, 100000);
    $output = [];
    foreach ($data as $value) {
        $output[] = $value;
    }
    $data = null;
}

// 処理終了後に最大メモリ使用量と終了時刻を取得
$maxMemoryUsage = (memory_get_peak_usage() - $baseMemoryUsage) / (1024 * 1024);
$processTime = microtime(true) - $baseTime;

// 計測結果を出力する
printf("Max Memory Usage : %.3f [MB]\n", $maxMemoryUsage);
printf("Process Time : %.2f [s]\n", $processTime);
