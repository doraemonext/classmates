<?php

require_once 'config.php';
require_once 'functions.php';

$userUid = '';
$title = '';
$subtitle = '';

session_start();
$cookieKey = sha1($_config['safe']['rand_cookie_key']);
if (isset($_COOKIE[$cookieKey])) {
    $userUid = $_COOKIE[$cookieKey];
}

showHeader($_config['website']['title'], $_config['website']['subtitle']);

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `options_value` FROM `options` WHERE `options_name` = "title"';
    $result = $db->query($query);
    $row = $result->fetch_object();
    $title = $row->options_value;    // 得到站点标题
    
    $query = 'SELECT `options_value` FROM `options` WHERE `options_name` = "subtitle"';
    $result = $db->query($query);
    $row = $result->fetch_object();
    $subtitle = $row->options_value;    // 得到站点副标题
} catch (Exception $e) {
    echoException($e);
}

$ui = getNewSmarty();
$ui->assign('title', $title);
$ui->assign('subtitle', $subtitle);
$ui->assign('pageLocated', 'index');
$ui->assign('userUid', $cookieValue);
$ui->display('index.tpl');

showFooter($_config['website']['title']);

?>
