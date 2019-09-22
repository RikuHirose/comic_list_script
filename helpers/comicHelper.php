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

  public function getComicStatusSuccess($crawler)
  {
    try {
      $success = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span.badge.badge-success.ml-2')->text();

    } catch ( Exception $ex ) {
      $success = null;
    }

    return $success;
  }

    public function getComicStatusWarnig($crawler)
  {
    try {
      $warning = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span.badge.badge-warning.ml-2')->text();

    } catch ( Exception $ex ) {
      $warning = null;
    }

    return $warning;
  }

  public function getComicStatus($crawler)
  {
    if (!is_null(self::getComicStatusWarnig($crawler))) {
      return self::getComicStatusWarnig($crawler);
    }

    if (!is_null(self::getComicStatusSuccess($crawler))) {
      return self::getComicStatusSuccess($crawler);
    }

    return null;
  }

  public function getComicWriterName($crawler)
  {
    try {
      $writerName = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(2) > td > a')->text('writer_name');

    } catch ( Exception $ex ) {
      $writerName = null;
    }

    return $writerName;
  }

  public function getComicPublishNumber($crawler)
  {
    try {
      $publishNumber = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(5) > td > span')->text('publish_number');

    } catch ( Exception $ex ) {
      $publishNumber = null;
    }

    return $publishNumber;
  }

  public function getComicDuration($crawler)
  {
    try {
      $duration = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(6) > td ')->text('duration');

    } catch ( Exception $ex ) {
      $duration = null;
    }

    return $duration;
  }

  public function getComicRating($crawler)
  {
    try {
      $rating = $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > p:nth-child(3) > span.text-muted.ml-2 ')->text('rating');

    } catch ( Exception $ex ) {
      $rating = null;
    }

    return $rating;
  }

  public function getComicImg($crawler)
  {
    try {
      $imgSrc = $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > img')->attr('src');

      if ($imgSrc === "/assets/no-image-77336935370ffcbbe44ab6ca534e7cb20e7198e9eb4900a3d43bc44ce4c2d930.png") {
        $imgSrc = null;
      }

    } catch ( Exception $ex ) {
      $imgSrc = null;
    }

    return $imgSrc;
  }

  public function getComicPublicationMagazine($crawler)
  {
    try {
      $publication_magazine = $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(4) > td ')->text('publication_magazine');

      if ($publication_magazine === "巻連載中") {
        $publication_magazine = null;
      }

    } catch ( Exception $ex ) {
      $publication_magazine = null;
    }

    return $publication_magazine;
  }

  public function createCsvData($crawler, $id)
  {
    $links = [
      $id,
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(1) > td')->text('comic_name'),
      self::getComicWriterName($crawler),
      $crawler->filter('body > div:nth-child(7) > table > tbody > tr:nth-child(3) > td ')->text('publisher'),
      self::getComicPublicationMagazine($crawler),
      self::getComicPublishNumber($crawler),
      self::getComicStatus($crawler),
      self::getComicDuration($crawler),
      self::getComicImg($crawler),
      self::getComicRating($crawler)
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
        $links[] = [
          $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > h2')->text('comic_name'),
          $crawler->filter('body > div:nth-child(6) > div:nth-child(5) > div > div > div.col-7 > h5')->text('application_name'),
          $crawler->filter('body > div:nth-child(6) > div:nth-child(5) > img')->attr('src')
        ];
      }

      if('body > div:nth-child(6) > div:nth-child(7)' == true) {
        $links[] = [
          $crawler->filter('body > div.container-fluid.container-bordered.bg-white.py-2 > div > div > h2')->text('comic_name'),
          $crawler->filter('body > div:nth-child(6) > div:nth-child(7) > div > div > div.col-7 > h5')->text('application_name'),
          $crawler->filter('body > div:nth-child(6) > div:nth-child(7) > img')->attr('src')
        ];
      }
    } catch(Exception $e) {
      // $links = null;
    };

    return $links;
  }
};