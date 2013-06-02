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
    
    $name = $rows->name;
    $sex = $rows->sex;
    $birthday = $rows->birthday;    
    $bloodType = $rows->blood_type;    
    $residence = $rows->residence;
    $giveOthers = $rows->give_others;
    
    $returnValue['status'] = "OK";
    $returnValue['name'] = $name;
    $returnValue['sex'] = $sex;
    $returnValue['birthday'] = $birthday;
    $returnValue['bloodType'] = $bloodType;
    $returnValue['residence'] = $residence;
    $returnValue['giveOthers'] = $giveOthers;
    
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>
