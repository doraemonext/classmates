<?php

/**
 * 文件说明：注册用户
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/tools/cookie.php';

@ $username = $_POST['username'];
@ $password = $_POST['password'];
@ $password_confirm = $_POST['password_confirm'];

$returnValue = array();

if (empty($username) || empty($password) || empty($password_confirm)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您没有填写完所有信息，请重试';
    echo json_encode($returnValue);
    exit();
}
if ((addslashes($username) != $username) || addslashes($password) != $password || addslashes($password_confirm) != $password_confirm) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的用户名或密码中含有非法字符';
    echo json_encode($returnValue);
    exit();
}

$username = addslashes($username);
$password = addslashes($password);
$password_confirm = addslashes($password_confirm);

if ($password != $password_confirm) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您两次输入的密码不相同';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `id` FROM `classmates` WHERE `name` = "'.$username.'"';
    $result = $db->query($query);
    
    if ($result->num_rows == 0) {
        $query = 'INSERT INTO classmates(name, password) VALUES ( "'.$username.'", "'.$password.'")';
        $db->query($query);
        $query = 'SELECT `id` FROM `classmates` WHERE `name` = "'.$username.'"';
        $result = $db->query($query);
        $userId = $result->fetch_object()->id;
        
        $userCookie = array(
            "user_id" => $userId,
            "login_ip" => $_SERVER['REMOTE_ADDR'],
            "login_time" => date('Y-m-d H:i:s')
        );
        $jsonStr = json_encode($userCookie);
        $cookieValue = encrypt($jsonStr, $_config['safe']['rand_cookie']);
        $_SESSION['userCookie'] = $cookieValue;
        
        $returnValue['status'] = 'OK';
        echo json_encode($returnValue);
        exit();
    } else if ($result->num_rows == 1) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '您的用户名在数据库中已经存在';
        echo json_encode($returnValue);
        exit();
        
        /*$object = $result->fetch_object();
        if (checkPassword($password, $salt, $object->password)) {
            $userCookie = array(
                "user_id" => $object->id,
                "login_ip" => $_SERVER['REMOTE_ADDR'],
                "login_time" => date('Y-m-d H:i:s')
            );
            $jsonStr = json_encode($userCookie);
            $cookieValue = encrypt($jsonStr, $_config['safe']['rand_cookie']);
            $_SESSION['userCookie'] = $cookieValue;
            
            $returnValue['status'] = 'OK';
            echo json_encode($returnValue);
            exit();
        } else {
            $returnValue['status'] = 'ERROR';
            $returnValue['statusInfo'] = '对不起，密码错误';   
            echo json_encode($returnValue);
            exit();
        }*/
    } else {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '出现意外错误，请联系管理员处理';   
        echo json_encode($returnValue);
        exit();
    }
} catch (Exception $e) {
    echoException($e);
}

?>