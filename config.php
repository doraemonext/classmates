<?php
require_once("libs/Smarty.class.php");

define(ROOT_PATH, dirname(__FILE__));

/** 数据库设置 **/
$_config['db']['host'] = '127.0.0.1';
$_config['db']['username'] = 'root';
$_config['db']['password'] = 'root';
$_config['db']['dbname'] = 'classmates';

/** Cookie 随机设置 **/
$_config['safe']['rand_cookie_key'] = '32HFVDFV98G987SDF87SF943HRSDF873';
$_config['safe']['rand_cookie_value'] = '45TG8UFB9H0F99354J78GH3RWEHQE12F';

define(MYSQL_ERROR, 1);

?>