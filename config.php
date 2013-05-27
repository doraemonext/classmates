<?php
require_once("libs/Smarty.class.php");
$ui = new Smarty;
$ui->setTemplateDir("smarty");
$ui->setCompileDir("smarty_compile");
$ui->setCacheDir("cache");
$ui->setConfigDir("configs");
$ui->assign("bootstrap_css_position", "templates/css/bootstrap.min.css");
$ui->assign("customize_css_position", "templates/css/style.css");

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "root";
$db_database = "classmates";
?>