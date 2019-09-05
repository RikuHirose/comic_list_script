<?php

/**
 * 
 */
class csvHelper
{

  function __construct()
  {
    # code...
  }

  /**
  * csvに書き込んだdataをarrayで取り出す
  **/
  public function csvToArray($filePath)
  {
    $file = array();
    foreach(glob($filePath) as $f){
      if(is_file($f)){
        $f = htmlspecialchars($f);
        $file[] = $f;
      }
    }


    $csv  = array();
    $fp   = fopen($file[0], "r");

    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
      $csv[] = $data;
    }
    fclose($fp);

    return $csv;
  }

  /**
  * dataをcsvに書きこむ
  **/
  public function writeToCsv($filePath, $data)
  {
    $f = fopen($filePath, "a");
    // 正常にファイルを開くことができていれば、書き込みます。
    if ( $f ) {

      fputcsv($f, $data);
    }
    // ファイルを閉じます。
    fclose($f);
  }

  /**
  * 多次元配列をフラットな配列に
  **/
  public function arrayFlatten($nestedArray)
  {
    return iterator_to_array(new RecursiveIteratorIterator(new RecursiveArrayIterator($nestedArray)), false);
  }
}