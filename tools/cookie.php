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

$_SESSION['userPrivilege'] = MEMBER_TOURIST;
if (isset($_SESSION['userCookie'])) {
    $_SESSION['userId'] = $userCookie['user_id'];
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT `privilege`, `banned_reason` FROM `classmates` WHERE `id` = '.$_SESSION['userId'];
        $result = $db->query($query);
        $rows = $result->fetch_object();
        $privilege = $rows->privilege;
        
        if ($privilege & MEMBER_BANNED) {
            $_SESSION['userPrivilege'] = MEMBER_BANNED;
            $_SESSION['bannedReason'] = $rows->banned_reason;
        }
        if ($privilege & MEMBER_UNVERIFY) {
            $_SESSION['userPrivilege'] = MEMBER_UNVERIFY;
        }
        if ($privilege & MEMBER_NORMAL) {
            $_SESSION['userPrivilege'] = MEMBER_NORMAL;
        }
        if ($privilege & MEMBER_ADMIN) {
            $_SESSION['userPrivilege'] = MEMBER_ADMIN;
        }
    } catch (Exception $e) {
        echoException($e);
    }
} else {
    unset($_SESSION['userId']);
}

?>
