<?php

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';
require_once dirname(__FILE__).'/tools/get_options.php';
require_once dirname(__FILE__).'/tools/cookie.php';

session_start();

$_SESSION['options'] = $_options;

// 取得标题和副标题信息
try {
    $title = getOption($_SESSION['options'], 'title');
    $subtitle = getOption($_SESSION['options'], 'subtitle');
} catch (Exception $e) {
    echoException($e);
}

// 显示头部
showHeader($title, $subtitle);

$ui = getNewSmarty();
$ui->assign('title', $title);
$ui->assign('subtitle', $subtitle);
$ui->assign('pageLocated', 'index');
if (isset($_SESSION['userCookie'])) {
    $ui->assign('uid', $_SESSION['userId']);
} else {
    $ui->assign('uid', -1);
}
$ui->display('index.tpl');

// 显示底部
showFooter($title);

?>
