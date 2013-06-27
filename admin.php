<?php

/**
 * 文件说明：个人信息管理页面
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';
require dirname(__FILE__).'/tools/get_options.php';
require dirname(__FILE__).'/tools/cookie.php';

$pageLocated = 'admin';

$isDisplay = $errorInfo = '';

switch ($_SESSION['userPrivilege']) {
    case MEMBER_TOURIST:
        $isDisplay = false;
        $errorInfo = '您尚未登陆，请登陆后重试。';
        break;
    case MEMBER_BANNED:
        $isDisplay = false;
        $errorInfo = '您的帐号已被管理员禁止，无法查看本页面。<br /><br />';
        $errorInfo .= '下面是管理员禁止您帐号的原因：<br /><br />';
        $errorInfo .= '<strong>'.$_SESSION['bannedReason'].'</strong><br /><br />';
        $errorInfo .= '如果您对此原因有任何异议，请联系管理员处理。';
        break;
    case MEMBER_UNVERIFY:
        $isDisplay = false;
        $errorInfo = '您尚未通过验证，请耐心等待管理员审核您的信息';
        break;
    case MEMBER_NORMAL:
        $isDisplay = false;
        $errorInfo = '您没有管理员权限，请联系管理员处理';
        break;
    case MEMBER_ADMIN:
        $isDisplay = true;
        $errorInfo = '';
        break;
    default:
        $isDisplay = false;
        $errorInfo = '发生未知错误，请联系管理员处理';
        break;
}

if ($isDisplay) {
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT `name` FROM `classmates` WHERE `id` = '.$_SESSION['userId'];
        $result = $db->query($query);
        $rows = $result->fetch_object();
        $username = $rows->name;
    } catch (Exception $e) {
        echoException($e);
    }
}

$actionName = '';
@ $action = $_GET['action'];
if (empty($action)) {
    $action = 'index';
}

@$status = $_GET['status'];
switch ($action) {
    case 'index':
        $actionName = '仪表盘';
        
        try {
            $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                               $_config['db']['password'], $_config['db']['dbname']);
            $query = 'SET NAMES UTF8';
            $db->query($query);
            $query = 'SELECT `privilege` FROM `classmates`';
            $result = $db->query($query);
            
            $indexCountBanned = $indexCountUnverify = $indexCountNormal = $indexCountAdmin = 0;
            $indexCountTotal = $result->num_rows;
            while ($rows = $result->fetch_object()) {
                switch ($rows->privilege) {
                    case MEMBER_BANNED:
                        $indexCountBanned++;
                        break;
                    case MEMBER_UNVERIFY:
                        $indexCountUnverify++;
                        break;
                    case MEMBER_NORMAL:
                        $indexCountNormal++;
                        break;
                    case MEMBER_ADMIN:
                        $indexCountAdmin++;
                        break;
                    default:
                        break;
                }
            }
        } catch (Exception $e) {
            echoException($e);
        }
        
        break;
    case 'setting':
        $actionName = '全局设置';
        
        try {
            $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                               $_config['db']['password'], $_config['db']['dbname']);
            $query = 'SET NAMES UTF8';
            $db->query($query);
            $query = 'SELECT * FROM `options`';
            $result = $db->query($query);
            
            while ($rows = $result->fetch_object()) {
                switch ($rows->options_name) {
                    case 'title':
                        $settingTitle = $rows->options_value;
                        break;
                    case 'subtitle':
                        $settingSubtitle = $rows->options_value;
                        break;
                    case 'index_writing':
                        $settingIndexWriting = $rows->options_value;
                        break;
                    default:
                        break;
                }
            }
        } catch (Exception $e) {
            echoException($e);
        }        
        
        break;
    case 'picture':
        $actionName = '图片轮播';
        
        try {
            $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                               $_config['db']['password'], $_config['db']['dbname']);
            $query = 'SET NAMES UTF8';
            $db->query($query);
            $query = 'SELECT * FROM `index_picture`';
            $result = $db->query($query);
            
            $pictureData = array();
            while ($rows = $result->fetch_object()) {
                $pictureData[$rows->id] = $rows->url;
            }
        } catch (Exception $e) {
            echoException($e);
        }         
        
        break;
    case 'motto':
        $actionName = '座右铭设置';
        
        try {
            $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                               $_config['db']['password'], $_config['db']['dbname']);
            $query = 'SET NAMES UTF8';
            $db->query($query);
            $query = 'SELECT * FROM `index_motto`';
            $result = $db->query($query);
            
            $mottoData = array();
            while ($rows = $result->fetch_object()) {
                $mottoData[$rows->id] = $rows->content;
            }
        } catch (Exception $e) {
            echoException($e);
        }         
        
        break;
    case 'user_admin':
        $actionName = '用户管理';

        try {
            $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                               $_config['db']['password'], $_config['db']['dbname']);
            $query = 'SET NAMES UTF8';
            $db->query($query);
            $query = 'SELECT `id`, `name`, `privilege` FROM `classmates`';
            $result = $db->query($query);
            
            $userData = array();
            while ($rows = $result->fetch_object()) {
                $userData[$rows->id] = array($rows->id, $rows->name, $rows->privilege);
            }
        } catch (Exception $e) {
            echoException($e);
        }   

        break;
    default:
        $isDisplay = false;
        $errorInfo = '您提供的参数非法，请通过正确途径进入此页面。';
}

$unverify = 0;
try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `privilege` FROM `classmates`';
    $result = $db->query($query);

    while ($rows = $result->fetch_object()) {
        if ($rows->privilege == 2) {
            $unverify++;
        }
    }
} catch (Exception $e) {
    echoException($e);
}         

$ui = getNewSmarty();
$ui->assign('basicInfo', getPageBasicInfo());
$ui->assign('userPrivilege', $_SESSION['userPrivilege']);
$ui->assign('pageLocated', $pageLocated);
$ui->assign('unverify', $unverify);
$ui->assign('isDisplay', $isDisplay);
$ui->assign('errorInfo', $errorInfo);
if ($isDisplay) {
    $ui->assign('userId', $_SESSION['userId']);
    $ui->assign('username', $username);
    $ui->assign('action', $action);
    $ui->assign('actionName', $actionName);
    $ui->assign('status', $status);
    
    switch ($action) {
        case 'index':
            $ui->assign('indexCountTotal', $indexCountTotal);
            $ui->assign('indexCountBanned', $indexCountBanned);
            $ui->assign('indexCountUnverify', $indexCountUnverify);
            $ui->assign('indexCountNormal', $indexCountNormal);
            $ui->assign('indexCountAdmin', $indexCountAdmin);
            break;
        case 'setting':
            $ui->assign('settingTitle', $settingTitle);
            $ui->assign('settingSubtitle', $settingSubtitle);
            $ui->assign('settingIndexWriting', $settingIndexWriting);
            break;
        case 'picture':
            $ui->assign('pictureData', $pictureData);
            break;
        case 'motto':
            $ui->assign('mottoData', $mottoData);
            break;
        case 'user_admin':
            $ui->assign('userData', $userData);
            break;
        default:
            break;
    }
}

if ($isDisplay) {
    $ui->display('admin.tpl');
} else {
    $ui->display('admin/admin_error.tpl');
}

?>
