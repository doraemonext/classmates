<?php

/**
 * 文件说明：同学录页面
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';
require dirname(__FILE__).'/tools/get_options.php';
require dirname(__FILE__).'/tools/cookie.php';

$pageLocated = 'classmates';

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
        $errorInfo = '您尚未通过验证，请耐心等待管理员审核您的信息。<br />在审核通过之前，您只能修改自己的资料，而不能查看其他人的信息。';
        break;
    case MEMBER_NORMAL:
        $isDisplay = true;
        $errorInfo = '';
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
    // 获取当先需要显示的页码
    @ $page = $_GET['page'];
    if ($page == null) {
        $page = 1;
    }
    
    if (!is_numeric($page) || $page < 1) {
        $isDisplay = false;
        $errorInfo = '您提供的页数非法。';
    }
    
    // 每页显示数目
    $perPageLimit = $_config['disp']['perpage_limit'];
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT `id`, `name`, `privilege` FROM `classmates`';
        $result = $db->query($query);
    } catch (Exception $e) {
        echoException($e);
    }
    // 总数目
    $total = $result->num_rows;
    // 总页数
    $totalPageSum = ceil($total / $perPageLimit);
    
    // 是否越界
    if ($page > $totalPageSum) {
        $isDisplay = false;
        $errorInfo = '您提供的页数非法。';
    }
    
    if ($isDisplay) {
        // 第一条记录位置偏移量
        $offset = ($page - 1) * $perPageLimit;
    
        $data = array();
        $step = -1;
        for ($i = 0; $i < min($offset + $perPageLimit, $total); $i++) {
            $rows = $result->fetch_object();
            if ($rows->privilege < MEMBER_NORMAL) {
                continue;
            }
            if ($i >= $offset) {
                if (($i - $offset) % 3 == 0) {
                    $step++;
                    $data[$step] = array();
                }
                array_push($data[$step], array($rows->id, $rows->name, getAvatarPath($rows->id)));
            }
        }
    }
}

$ui = getNewSmarty();
$ui->assign('basicInfo', getPageBasicInfo());
$ui->assign('userPrivilege', $_SESSION['userPrivilege']);
$ui->assign('pageLocated', $pageLocated);

$ui->assign('isDisplay', $isDisplay);
$ui->assign('errorInfo', $errorInfo);
if ($isDisplay) {
    $ui->assign('page', $page);
    $ui->assign('perPageLimit', $perPageLimit);
    $ui->assign('total', $total);
    $ui->assign('totalPageSum', $totalPageSum);
    $ui->assign('offset', $offset);
    $ui->assign('data', $data);
}

$ui->display('classmates.tpl');

?>
