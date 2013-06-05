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

$pageLocated = 'account';

$isDisplay = "true";
if (!isset($_SESSION['userCookie'])) {
    $isDisplay = "false";
}

// 取得标题和副标题信息
try {
    $title = getOption($_options, 'title');
    $subtitle = getOption($_options, 'subtitle');
} catch (Exception $e) {
    echoException($e);
}

// 显示头部
if (isset($_SESSION['userCookie'])) {
    showHeader($title, $subtitle, $pageLocated, 'known');
} else {
    showHeader($title, $subtitle, $pageLocated, 'unknown');
}

$ui = getNewSmarty();
$ui->assign('title', $title);
$ui->assign('subtitle', $subtitle);
$ui->assign('pageLocated', $pageLocated);
$ui->assign('isDisplay', $isDisplay);
if ($isDisplay == "true") {
    $ui->assign('userId', $_SESSION['userId']);
}
$ui->display('account.tpl');

// 显示底部
showFooter($title);

?>
