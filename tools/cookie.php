<?php

/**
 * 文件说明：验证cookie
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

if (isset($_SESSION['userCookie'])) {
    // 解密后的字符串末尾有 \0，需要用 trim 去除
    $cookie_json_string = trim(decrypt($_SESSION['userCookie'], $_config['safe']['rand_cookie']));
    $userCookie = json_decode($cookie_json_string, true);
    
    if ($userCookie['login_ip'] != $_SERVER['REMOTE_ADDR']) {
        unset($_SESSION['userCookie']);
    }
    if (floor((strtotime(date('Y-m-d H:i:s')) - strtotime($userCookie['login_time'])) % 86400 % 60) > 7200) {
        unset($_SESSION['userCookie']);
    }
}

if (isset($_SESSION['userCookie'])) {
    $_SESSION['userId'] = $userCookie["user_id"];
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT `admin` FROM `classmates` WHERE `id` = '.$_SESSION['userId'];
        $result = $db->query($query);
        $rows = $result->fetch_object();
        
        if ($rows->admin == 1) {
            $_SESSION['admin'] = 1;
        } else {
            unset($_SESSION['admin']);
        }
    } catch (Exception $e) {
        echoException($e);
    }
} else {
    unset($_SESSION['userId']);
}

?>
