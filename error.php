<?php

/**
 * 文件说明：
 * 
 * 当 $content 不为空的时候，是说明性错误，需要将 $content 的内容输出
 * 当 $content 为空的时候，是异常抛出的错误，需要将异常内容输出
 *
 * @author     Doraemonext
 */
require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';

$content = $_GET['content'];

$code = $_GET['code'];
$msg = $_GET['msg'];
$file = $_GET['file'];
$line = $_GET['line'];

$ui = getNewSmarty();

if (!empty($content)) {
    printLog($content);
    $ui->assign('error_type', 'plain');
    $ui->assign('content', $content);
} else {
    printLog('Exception '.$code.': '.$msg.' in '.$file.' on line '.$line.'.');
    $ui->assign('error_type', 'exception');
    $ui->assign('code', $code);
    $ui->assign('msg', $msg);
    $ui->assign('file', $file);
    $ui->assign('line', $line);
}

$ui->display('error.tpl');

?>
