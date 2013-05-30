<?php

/**
 * 文件说明：验证登录信息
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/tools/cookie.php';

@ $username = $_POST['username'];
@ $password = $_POST['password'];
@ $salt = $_POST['salt'];

$returnValue = array();

if (empty($username) || empty($password) || empty($salt)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您没有填写完所有信息，请重试';
    echo json_encode($returnValue);
    exit();
}
if ((addslashes($username) != $username) || addslashes($password) != $password || addslashes($salt) != $salt) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的用户名或密码中含有非法字符';
    echo json_encode($returnValue);
    exit();
}

$username = addslashes($username);
$password = addslashes($password);
$salt = addslashes($salt);

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT `id`, `password` FROM `classmates` WHERE `name` = "'.$username.'"';
    $result = $db->query($query);
    
    if ($result->num_rows == 0) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，数据库中没有此用户';   
        echo json_encode($returnValue);
        exit();
    } else if ($result->num_rows == 1) {
        $object = $result->fetch_object();
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
        }
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
