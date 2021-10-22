<?php
require '../libraries/ua.class.php';
require '../libraries/simple_html_dom.php';

require '../core/functions/options.php';
require '../core/functions/cache.php';
require '../core/functions/permalinks.php';
require '../core/functions/common.php';
require '../core/functions/site.php';
require '../core/classes/agc.php';
$cari = $_GET['s'];
$limit = $_GET['l'];
$result = agc()->get_inject($cari, $limit);

echo json_encode($result);
?>