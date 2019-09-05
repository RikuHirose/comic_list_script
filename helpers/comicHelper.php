<?php
/**
 *
 */
class comicHelper
{

  function __construct()
  {
    # code...
  }

  public function createCsvData($crawler, $id)
  {
    $links = [
      $id,
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(1) > td')->text('comic_name'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(2) > td > a')->text('writer_name'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(3) > td ')->text('publisher'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(4) > td ')->text('publication_magazine'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span')->text('publish_number'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span.badge.badge-success.ml-2')->text('completion'),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(6) > td ')->text('duration'),
      $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > img')->attr('src'),
    ];

    return $links;
  }
}