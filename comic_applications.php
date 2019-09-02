<?php

require_once __DIR__ . '/vendor/autoload.php';
$cli = new Goutte\Client();
// /comics?page=1から /comics?page=567の/comics/{comics} urlを取得
$file = "";

$url = "https://manga-check.com/comics/28129";
$crawler = $cli->request('GET',$url);

$links = [
    $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > h2')->text('comic_name'),
    
    $crawler->filter('body > div:nth-child(6) > div:nth-child(3) > div > div > div.col-7 > h5')->text('application_name'),
    $crawler->filter('body > div:nth-child(6) > div:nth-child(3) > img')->attr('src')
];

var_dump($links);


// $f = fopen("./data/comic_applications.csv", "comic_name");
//   // 正常にファイルを開くことができていれば、書き込みます。
//   if ( $f ) {

//     fputcsv($f, $links);
//   }
//   // ファイルを閉じます。
//   fclose($f);



