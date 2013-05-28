<?php
/**
 * 文件说明：为 Classmates 提供必要的函数支持
 *
 * @author     Doraemonext
 */

/*
 * 得到一个新的 Smarty 变量，并做好初始化工作
 */
function getNewSmarty() 
{
    $ui = new Smarty;
    
    $ui->setCompileDir("smarty_compile");
    $ui->setTemplateDir("smarty");
    $ui->setCacheDir("cache");
    $ui->setConfigDir("configs");
    // $ui->debugging = false;
    $ui->assign('pageLocated', 'UNKNOWN');
    
    return $ui;
}

/*
 * 显示头部 HTML 内容
 */
function showHeader($title, $subtitle)
{
    $ui = getNewSmarty();
    $navigationPage = array(
        '同学录' => 'classmates.php',
        '精彩瞬间' => 'show_picture.php',
        '视频掠影' => 'show_video.php',
        '时间轴' => 'timeaxis.php'
        );
    
    $ui->assign('title', $title);
    $ui->assign('subtitle', $subtitle);
    $ui->assign('navigationPage', $navigationPage);
    
    $ui->display('header.tpl');
}

/*
 * 显示底部 HTML 内容
 */
function showFooter($title)
{
    $ui = getNewSmarty();
    
    $ui->assign('title', $title);
    
    $ui->display('footer.tpl');
}

/*
 * 连接数据库的初始化工作
 */
function mysqlConnect($host, $username, $password, $dbname) {
    @ $db = new mysqli($host, $username, $password, $dbname);
    //if (mysqli_connect_errno()) {
    if (1) {
        throw new Exception("连接数据库时发生错误", MYSQL_ERROR);
        exit;
    }
    return $db;
}

/*
 * 打印异常信息（直接打开error.php页面并显示）
 */
function echoException($e) {
    $code = $e->getCode();
    $msg = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo '<meta http-equiv=refresh content=0;url="error.php?code='.$code.'&msg='.$msg.'&file='.$file.'&line='.$line.'">';
}

/*
 * 输出error log文件
 */
function printLog($log) {
    file_put_contents('error.log', date("Y-m-d H:i:s"). " " . $log. "\r\n", FILE_APPEND | LOCK_EX);
}

?>
