<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helper.php';

$cli    = new Goutte\Client();
$helper = new Helper();

/**
**  comics.csvとcomic_applications.csvから
    applications.csvを作成

    name,img_url
**/

$comics             = $helper->csvToArray("./data/comics.csv");
$comic_applications = $helper->csvToArray("./data/comic_applications.csv");

$tmp = [];
$applications = [];
foreach ($comic_applications as $key => $application) {
  $comic_name          = $application[0];
  $application_name    = $application[1];
  $application_img_url = $application[2];

  // $comic_nameを削除
  array_shift($application);

  // 配列に値が見つからなければ$tmpに格納
  if (!in_array($application_name, $tmp)) {
    $tmp[]          = $application_name;
    $applications[] = $application;

  }
}

foreach ($applications as $key => $application) {
  $helper->writeToCsv("./data/applications.csv", $application);
}