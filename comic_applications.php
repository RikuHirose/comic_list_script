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

$crawler      = $cli->request('GET',$url);
$csvAppData   = $comicHelper->createCsvAppData($crawler);

foreach ($csvAppData as $key => $data) {

  $csvHelper->writeToCsv("./data/comic_applications.csv", $data);

}