<?php

require_once __DIR__ . '/helpers/csvHelper.php';

$csvHelper   = new csvHelper();

$sql = "SELECT * FROM comic_applications";

$stmt = $dbh->query($sql);
$data = $stmt;

foreach ($data as $row) {
    $csvHelper->writeToCsv("./data/comic_applications2.csv", $data);
}