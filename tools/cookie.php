<?php

/**
 * 文件说明：验证cookie
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

session_start();

if (isset($_COOKIE['userCookie'])) {
    $cookie_json_string = decrypt($_COOKIE['userCookie'], $_config['safe']['rand_cookie']);
    $userCookie = json_decode($cookie_json_string);
    
    if ($userCookie['login_ip'] != $_SERVER['REMOTE_ADDR']) {
        unset($_COOKIE['userCookie']);
    }
    if (floor((strtotime(date('Y-m-d H:i:s')) - strtotime($userCookie['login_time'])) % 86400 % 60) > 7200) {
        unset($_COOKIE['userCookie']);
    }
}

if (isset($_COOKIE['userCookie'])) {
    $_SESSION['userId'] = $userCookie['user_id'];
} else {
    unset($_SESSION['userId']);
}

$_SESSION['userCookie'] = 'xxx';
$_SESSION['userId'] = 1;

?>
