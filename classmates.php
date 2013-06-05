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

$isDisplay = "true";
if (!isset($_SESSION['userCookie'])) {
    $isDisplay = "false";
}

// 获取当先需要显示的页码
@ $page = $_GET['page'];
if ($page == null) {
    $page = 1;
}

if (!is_numeric($page) || $page < 1) {
    $isDisplay = "false";
}

// 每页显示数目
$perPageLimit = $_config['disp']['perpage_limit'];
try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `id`, `name` FROM `classmates`';
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
    $isDisplay = "false";
}

// 第一条记录位置偏移量
$offset = ($page - 1) * $perPageLimit;

$data = array();
$step = -1;
for ($i = 0; $i < min($offset + $perPageLimit, $total); $i++) {
    $rows = $result->fetch_object();
    if ($i >= $offset) {
        if (($i - $offset) % 3 == 0) {
            $step++;
            $data[$step] = array();
        }
        array_push($data[$step], array($rows->id, $rows->name, getAvatarPath($rows->id)));
    }
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

$ui->assign('page', $page);
$ui->assign('isDisplay', $isDisplay);
$ui->assign('perPageLimit', $perPageLimit);
$ui->assign('total', $total);
$ui->assign('totalPageSum', $totalPageSum);
$ui->assign('offset', $offset);
$ui->assign('data', $data);

$ui->display('classmates.tpl');

// 显示底部
showFooter($title);

?>
