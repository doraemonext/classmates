<?php

/**
 * 文件说明：提交管理后台的“全局设置”
 * 
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../../functions.php';

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

$title = addslashes($_POST['title']);
$subtitle = addslashes($_POST['subtitle']);
$indexWriting = htmlspecialchars($_POST['indexWriting']);

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `options` SET `options_value` = "'.$title.'" WHERE `options_name` = "title"';
    $db->query($query);
    $query = 'UPDATE `options` SET `options_value` = "'.$subtitle.'" WHERE `options_name` = "subtitle"';
    $db->query($query);
    $query = 'UPDATE `options` SET `options_value` = "'.$indexWriting.'" WHERE `options_name` = "index_writing"';
    $db->query($query);
    
    $returnValue['status'] = "OK";
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>

