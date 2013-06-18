<?php

/**
 * 文件说明：返回用户名及头像地址
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$_SESSION['userId'] = intval($_SESSION['userId']);

$returnValue = array();

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '您好，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `name` FROM `classmates` WHERE `id` = '.$_SESSION['userId'];
    $result = $db->query($query);
    if ($result->num_rows != 1) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '您好，数据库异常，请联系管理员';
        echo json_encode($returnValue);
        exit();
    }
    
    $rows = $result->fetch_object();
    $returnValue['status'] = 'OK';
    $returnValue['username'] = $rows->name;
    $returnValue['avatar'] = getAvatarPath($_SESSION['userId']);
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}

?>
