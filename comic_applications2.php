<?php

require_once __DIR__ . '/helpers/csvHelper.php';

$csvHelper   = new csvHelper();

// comic_applications.csvからcomic_id, application_idのcsvを作る
// comic、applicationをdbに入れてsql検索した方が楽?