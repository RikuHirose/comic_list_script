<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers/csvHelper.php';
require_once __DIR__ . '/helpers/comicHelper.php';

$cli         = new Goutte\Client();
$csvHelper   = new csvHelper();
$comicHelper = new comicHelper();

// https://manga-check.com/comics/28129"
// appが3つ
// https://manga-check.com/comics/70435
// appなし
// https://manga-check.com/comics/7720
// $a = [
//   'https://manga-check.com/comics/28129',
//   'https://manga-check.com/comics/7720',
//   'https://manga-check.com/comics/70435',
// ];

// https://manga-check.com/comics/15596
// から

$urls    = $csvHelper->csvToArray("./data/urlsComicApplication.csv");
$newUrls = $csvHelper->arrayFlatten($urls);

$endPoint = "https://manga-check.com";

foreach ($newUrls as $key => $url) {

  echo $endPoint.$url."のdataを書き込んでいます...\n";

  $crawler     = $cli->request('GET',$endPoint.$url);
  $csvAppData  = $comicHelper->createCsvAppData($crawler);

  if (!is_null($csvAppData)) {
    foreach ($csvAppData as $key => $data) {
      $csvHelper->writeToCsv("./data/comic_applications.csv", $data);
    }
  }

  sleep(1);
}