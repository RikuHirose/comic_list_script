<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers/csvHelper.php';
require_once __DIR__ . '/helpers/comicHelper.php';

$cli = new Goutte\Client();
$csvHelper   = new csvHelper();
$comicHelper = new comicHelper();
// /comics?page=1から /comics?page=567の/comics/{comics} urlを取得
$file = "";


$url = "https://manga-check.com/comics/28129";

$crawler = $cli->request('GET',$url);
$links   = $comicHelper->createCsvAppData($crawler);

var_dump($links);

// $csvHelper->writeToAppCsv("./data/comic_applications.csv", $links);

// $f = fopen("./data/comic_applications.csv", "r+");

// // 正常にファイルを開くことができていれば、書き込みます。
// if ( $f ) {

//   fputcsv($f, $links);
// }
// // ファイルを閉じます。
// fclose($f);