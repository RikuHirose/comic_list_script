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
      $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > p:nth-child(3) > span.text-muted.ml-2 ')->text('rating'),
    ];

    return $links;
  }

  public function createCsvAppData($crawler)
  {
    try {
      if('body > div:nth-child(6) > div:nth-child(3)' == true) { 
        $links= [
          [$crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > h2')->text('comic_name'),
           $crawler->filter('body > div:nth-child(6) > div:nth-child(3) > div > div > div.col-7 > h5')->text('application_name'),
           $crawler->filter('body > div:nth-child(6) > div:nth-child(3) > img')->attr('src')],
        ];
      }

      if('body > div:nth-child(6) > div:nth-child(5)' == true) { 
        $links[] = 
          [$crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > h2')->text('comic_name'),
           $crawler->filter('body > div:nth-child(6) > div:nth-child(5) > div > div > div.col-7 > h5')->text('application_name'),
           $crawler->filter('body > div:nth-child(6) > div:nth-child(5) > img')->attr('src')];
      }
    } catch(Exception $e) {
      echo null;
    };

    return $links;
  }
};