<?php

/**
 * 文件说明：管理后台的图片删除操作
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

$id = json_decode(unescape($_POST['id']));

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    for ($i = 0; $i < count($id); $i++) {
        $query = 'SELECT `url` FROM `index_picture` WHERE `id` = '.$id[$i];
        $result = $db->query($query);
        $rows = $result->fetch_object();
        $url = $rows->url;
        if (substr($url, 0, 6) == "images") {
            $path = dirname(__FILE__).'/../../'.$url;
            @ unlink($path);
        }
        
        $query = 'DELETE FROM `index_picture` WHERE `id` = '.$id[$i];
        $db->query($query);
    }
      
    $returnValue['status'] = "OK";
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>

