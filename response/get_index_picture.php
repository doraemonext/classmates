<?php

/**
 * 文件说明：获取首页轮播图片地址
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../tools/cookie.php';

$returnValue = array();

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `url` FROM `index_picture`';
    $result = $db->query($query);
    $total = $result->num_rows;
    
    $returnValue['total'] = $total;
    $cnt = 0;
    while ($rows = $result->fetch_object()) {
        $returnValue['img'][$cnt] = $rows->url;
        $cnt++;
    }
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}

?>
