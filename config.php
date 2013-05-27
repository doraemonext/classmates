<?php
require_once("libs/Smarty.class.php");

define(ROOT_PATH, dirname(__FILE__));

/** 数据库设置 **/
$_config['db']['host'] = '127.0.0.1';
$_config['db']['username'] = 'root';
$_config['db']['password'] = 'root';
$_config['db']['dbname'] = 'classmates';

/** 站点名称设置 **/
$_config['website']['title'] = '永远的 448 ';
$_config['website']['subtitle'] = '管王无敌！';
$_config['website']['meta'] = '';
$_config['website']['keyword'] = '';

?>