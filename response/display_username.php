<?php

/**
 * 文件说明：返回用户名
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';
require_once dirname(__FILE__).'/../tools/cookie.php';

session_start();

/*if (!isset($_COOKIE['userCookie'])) {
    echo '-1';  // 表示cookie出错，无法得到用户名
    exit();
}*/

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `name` FROM `classmates` WHERE `id` = '.intval($_SESSION['userId']);
    $result = $db->query($query);
    echo addslashes($result->fetch_object()->name);
} catch (Exception $e) {
    echoException($e);
}

?>
