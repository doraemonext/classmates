<?php

/**
 * 文件说明：安全退出
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

$_SESSION = array();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

echo 'OK';

?>
