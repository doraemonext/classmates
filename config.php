<?php
require_once "libs/smarty/Smarty.class.php";

date_default_timezone_set("PRC");
session_start();

/** 数据库设置 **/
$_config['db']['host'] = '127.0.0.1';
$_config['db']['username'] = 'root';
$_config['db']['password'] = 'root';
$_config['db']['dbname'] = 'classmates';

/** Cookie 随机设置 **/
$_config['safe']['rand_cookie'] = 'RWEHQE12F';

/** 页面名称设置 **/
$_config['page']['classmates'] = '同学录';
$_config['page']['show_picture'] = '精彩瞬间';
$_config['page']['show_video'] = '视频掠影';

/** 通讯录页面每页显示多少人 **/
$_config['disp']['perpage_limit'] = 18;

define('MYSQL_ERROR', 1);
define('GET_OPTIONS_ERROR', 2);

define('MEMBER_TOURIST', 0);
define('MEMBER_BANNED', 1);
define('MEMBER_UNVERIFY', 2);
define('MEMBER_NORMAL', 4);
define('MEMBER_ADMIN', 8);

?>
