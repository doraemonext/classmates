<?php
require_once "libs/smarty/Smarty.class.php";

session_start();

/** 数据库设置 **/
$_config['db']['host'] = '127.0.0.1';
$_config['db']['username'] = 'root';
$_config['db']['password'] = 'root';
$_config['db']['dbname'] = 'classmates';

/** Cookie 随机设置 **/
$_config['safe']['rand_cookie'] = 'RWEHQE12F';

define(MYSQL_ERROR, 1);
define(GET_OPTIONS_ERROR, 2);

?>