<?php

require_once __DIR__ . '/vendor/autoload.php';
$cli = new Goutte\Client();
// /comics?page=1から /comics?page=567の/comics/{comics} urlを取得
$file = "";


$url = "https://manga-check.com/comics/11143";
$crawler = $cli->request('GET',$url);


$links = [
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(1) > td')->text('comic_name'),
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(2) > td > a')->text('writer_name'),
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(3) > td ')->text('publisher'),
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(4) > td ')->text('publication_magazine'),
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span')->text('publish_number'),
    $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(6) > td ')->text('duration'),
];

// var_dump($links);


$f = fopen("./data/comics.csv", "comic_name");
  // 正常にファイルを開くことができていれば、書き込みます。
  if ( $f ) {

    fputcsv($f, $links);
  }
  // ファイルを閉じます。
  fclose($f);



