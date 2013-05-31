<?php

/**
 * 文件说明：提交“个人信息管理”页面的“基本信息给数据库
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

@ $sex = $_POST['sex'];
@ $birthday = $_POST['birthday'];
@ $bloodType = $_POST['bloodType'];
@ $residence = $_POST['residence'];
@ $giveOthers = $_POST['giveOthers'];

if ($sex == 'man') {
    $sex = 0;
} else {
    $sex = 1;
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `classmates` SET `sex`='.$sex.', `birthday`="'.$birthday.'", `blood_type`='.$bloodType.', `residence`="'.$residence.'", `give_others`="'.$giveOthers.'" WHERE `id`='.$_SESSION['userId'];
    $db->query($query);
} catch (Exception $e) {
    echoException($e);
}

?>
