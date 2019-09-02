<?php

require_once __DIR__ . '/vendor/autoload.php';
$cli = new Goutte\Client();
// /comics?page=1から /comics?page=567の/comics/{comics} urlを取得
$file = "";

for ($i=1; $i < 568; $i++) {
  echo $i."ページのurlsを取得中...\n";

  $url = "https://manga-check.com/comics?page=".$i;
  $crawler = $cli->request('GET',$url);

  // url リスト取得
  $links = $crawler->filter('body > div.container-fluid.bg-white.py-3.mt-2 > a')->extract('href');

  $f = fopen("./data/urls.csv", "a");
  // 正常にファイルを開くことができていれば、書き込みます。
  if ( $f ) {

    fputcsv($f, $links);
  }
  // ファイルを閉じます。
  fclose($f);

  sleep(3);
}



/**
* urls.csvに書き込んだurlsをarrayで取り出す
**/
// $file = array();
// foreach(glob("/Users/rikuparkour1996/www/comic_list_script/data/urls.csv") as $f){
//   if(is_file($f)){
//     $f = htmlspecialchars($f);
//     $file[] = $f;
//   }
// }


// $csv  = array();
// $fp   = fopen($file[0], "r");

// while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
//   $csv[] = $data;
// }
// fclose($fp);

// var_dump($csv);die;