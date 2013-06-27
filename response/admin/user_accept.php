<?php

/**
 * 文件说明：使得用户通过验证
 * 
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../../functions.php';

require dirname(__FILE__).'/../../safe.php';
require dirname(__FILE__).'/../../tools/cookie.php';

$returnValue = array();

switch ($_SESSION['userPrivilege']) {
    case MEMBER_TOURIST:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，您尚未登陆或 Cookie 失效，请刷新本页面后重新登陆。';
        echo json_encode($returnValue);
        exit();
        break;
    case MEMBER_BANNED:
    case MEMBER_UNVERIFY:
    case MEMBER_NORMAL:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，您没有管理员权限，请联系管理员处理。';
        echo json_encode($returnValue);
        exit();
        break;
    case MEMBER_ADMIN:
        break;
    default:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，发生未知错误，请联系管理员处理。';
        echo json_encode($returnValue);
        exit();
        break;
}

$id = addslashes(unescape($_POST['id']));
$privilege = addslashes(unescape($_POST['privilege']));

if (!is_numeric($id) || !is_numeric($privilege)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您提交的参数有误，请重试。';
    echo json_encode($returnValue);
    exit();
}
if ($privilege != MEMBER_NORMAL && $privilege != MEMBER_UNVERIFY && 
    $privilege != MEMBER_BANNED && $privilege != MEMBER_TOURIST) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您提交的参数有误，请重试。';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `classmates` SET `privilege` = '.$privilege.' WHERE `id` = '.$id;
    $db->query($query);
    
    $returnValue['status'] = "OK";
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>
