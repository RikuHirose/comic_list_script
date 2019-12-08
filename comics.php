<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers/csvHelper.php';
require_once __DIR__ . '/helpers/comicHelper.php';

$cli         = new Goutte\Client();
$csvHelper   = new csvHelper();
$comicHelper = new comicHelper();


// $urls    = $csvHelper->csvToArray("./data/urls.csv");
$urls    = $csvHelper->csvToArray("./data/urlscomic.csv");
$newUrls = $csvHelper->arrayFlatten($urls);


$endPoint = "https://manga-check.com";

foreach ($newUrls as $key => $url) {
  echo $endPoint.$url."のdataを書き込んでいます...\n";

  $crawler = $cli->request('GET',$endPoint.$url);
  $id      = $key + 10532;
  $data    = $comicHelper->createCsvData($crawler, $id);
  $csvHelper->writeToCsv("./data/comics.csv", $data);

  sleep(3);

}
