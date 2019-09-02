<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helper.php';

$cli    = new Goutte\Client();
$helper = new Helper();
// /comics?page=1から /comics?page=567の/comics/{comics} urlを取得
$file = "";

for ($i=1; $i < 568; $i++) {
  echo $i."ページのurlsを取得中...\n";

  $url = "https://manga-check.com/comics?page=".$i;
  $crawler = $cli->request('GET',$url);

  // url リスト取得
  $links = $crawler->filter('body > div.container-fluid.bg-white.py-3.mt-2 > a')->extract('href');

  $helper->writeToCsv("./data/urls.csv", $links);

  sleep(3);
}

