<?php

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';
require dirname(__FILE__).'/tools/get_options.php';
require dirname(__FILE__).'/tools/cookie.php';

$pageLocated = 'show_video';

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

$ui = getNewSmarty();
$ui->assign('basicInfo', getPageBasicInfo());
$ui->assign('userPrivilege', $_SESSION['userPrivilege']);
$ui->assign('pageLocated', $pageLocated);

$ui->assign('isDisplay', $isDisplay);
$ui->assign('errorInfo', $errorInfo);

$ui->display('show_video.tpl');

?>