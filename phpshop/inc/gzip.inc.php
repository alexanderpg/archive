<?php

/**
 * Сжатие и кэш
 */
$cache_key = md5(str_replace("www.", "", getenv('SERVER_NAME')) . parse_url($_SERVER['REQUEST_URI'])['path']);
$PHPShopCache = new PHPShopCache($cache_key);
$PHPShopCache->init();

// URL
if ($PHPShopCache->valid_url() and $PHPShopCache->mod == 1) {
    $cache = $PHPShopCache->display($cache_key);
}
// AJAX
elseif(!$PHPShopCache->valid_url() and count($_POST) > 0 and $PHPShopCache->mod == 1) {
    $cache_key = md5(str_replace("www.", "", getenv('SERVER_NAME')) . $_SERVER['REQUEST_URI'] . http_build_query($_POST));

    if (isset($_POST['json']))
        header('Content-type: application/json; charset=UTF-8');

    $cache = $PHPShopCache->display($cache_key);
}

if (!empty($cache)) {
    
    echo $cache;
    echo $PHPShopCache->debug();
    
    $PHPShopCache->gzip(false);
}
