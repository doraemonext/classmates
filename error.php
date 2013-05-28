<?php

/**
 * 文件说明：
 *
 * @author     Doraemonext
 */

require_once 'config.php';
require_once 'functions.php';

$code = $_GET['code'];
$msg = $_GET['msg'];
$file = $_GET['file'];
$line = $_GET['line'];

printLog('Exception '.$code.': '.$msg.' in '.$file.' on line '.$line.'.');

$ui = getNewSmarty();
$ui->assign('code', $code);
$ui->assign('msg', $msg);
$ui->assign('file', $file);
$ui->assign('line', $line);

$ui->display('error.tpl');

?>
