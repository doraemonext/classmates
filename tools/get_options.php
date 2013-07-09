<?php

/**
 * 文件说明：
 *
 * @author     Doraemonext
 */
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

// 取得所有选项信息
try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT * FROM `options`';
    $_options = $db->query($query);
} catch (Exception $e) {
    echoException($e);
}

?>
