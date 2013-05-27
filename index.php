<?php

require_once 'config.php';
require_once 'functions.php';

session_start();

$validUser = sha1('1');
if (isset($_COOKIE['validUser'])) {
    $validUser = $_COOKIE['validUser'];
}

showHeader($_config['website']['title'], $_config['website']['subtitle']);

$ui = getNewSmarty();
$ui->assign('title', $_config['website']['title']);
$ui->assign('subtitle', $_config['website']['subtitle']);
$ui->assign('pageLocated', 'index');
$ui->assign('validUser', $validUser);
$ui->display('index.tpl');

showFooter($_config['website']['title']);

?>
