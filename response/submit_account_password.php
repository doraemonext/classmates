<?php

/**
 * 文件说明：提交“个人信息管理”页面的“密码”
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

@ $originPassword = unescape($_POST['originPassword']);
@ $newPassword = unescape($_POST['newPassword']);
@ $confirmPassword = unescape($_POST['confirmPassword']);

$returnValue = array();

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

if (empty($originPassword) || empty($newPassword) || empty($confirmPassword)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您没有填写完所有信息，请重试';
    echo json_encode($returnValue);
    exit();
}
if ((addslashes($originPassword) != $originPassword) || addslashes($newPassword) != $newPassword || addslashes($confirmPassword) != $confirmPassword) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的密码中含有非法字符';
    echo json_encode($returnValue);
    exit();
}

if ($newPassword != $confirmPassword) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您两次输入的新密码不相同';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `password` FROM `classmates` WHERE `id` = '.$_SESSION['userId'];
    $result = $db->query($query);
    $rows = $result->fetch_object();
    if ($rows->password != $originPassword) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，您输入的原密码不正确';
        echo json_encode($returnValue);
        exit();
    }
    $query = 'UPDATE `classmates` SET `password` = "'.$newPassword.'"';
    $db->query($query);
    
    $returnValue['status'] = 'OK';
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}

?>
