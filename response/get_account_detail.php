<?php

/**
 * 文件说明：返回“个人信息管理”页面的“基本信息
 * 
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$returnValue = array();

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT * FROM `classmates` WHERE `id` = '.intval($_SESSION['userId']);
    $result = $db->query($query);
    if ($result->num_rows != 1) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '您好，数据库异常，请联系管理员';
        echo json_encode($returnValue);
        exit();
    }
    
    $rows = $result->fetch_object();
    
    $nation = $rows->nation;
    $weight = $rows->weight;
    $height = $rows->height;
    $speciality = $rows->speciality;
    $email = $rows->email;
    $qq = $rows->qq;
    $phone_1 = $rows->phone_1;
    $phone_2 = $rows->phone_2;
    $phone_3 = $rows->phone_3;
    
    $returnValue['status'] = "OK";
    
    $returnValue['nation'] = $nation;
    $returnValue['weight'] = $weight;
    $returnValue['height'] = $height;
    $returnValue['speciality'] = $speciality;
    $returnValue['email'] = $email;
    $returnValue['qq'] = $qq;
    $returnValue['phone_1'] = $phone_1;
    $returnValue['phone_2'] = $phone_2;
    $returnValue['phone_3'] = $phone_3;
    
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>

