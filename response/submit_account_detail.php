<?php

/**
 * 文件说明：提交“个人信息管理”页面的“详细信息给数据库
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$returnValue = array();
$submit = json_decode(unescape($_POST['json']), true);

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

for ($i = 0; $i < count($submit); $i++) {
    switch ($submit[$i]['name']) {
        case 'account_nation':
            $nation = $submit[$i]['value'];
            break;
        case 'account_weight':
            $weight = $submit[$i]['value'];
            break;
        case 'account_height':
            $height = $submit[$i]['value'];
            break;
        case 'account_speciality':
            $speciality = $submit[$i]['value'];
            break;
        case 'account_email':
            $email = $submit[$i]['value'];
            break;
        case 'account_qq':
            $qq = $submit[$i]['value'];
            break;
        case 'account_phone_1':
            $phone_1 = $submit[$i]['value'];
            break;
        case 'account_phone_2':
            $phone_2 = $submit[$i]['value'];
            break;
        case 'account_phone_3':
            $phone_3 = $submit[$i]['value'];
            break;
        default:
            $returnValue['status'] = 'ERROR';
            $returnValue['statusInfo'] = '系统处理提交数据时发生错误，请联系管理员解决';
            echo json_encode($returnValue);
            exit();
    }
}

$nation = trim(addslashes($nation));
$weight = trim(addslashes($weight));
$height = trim(addslashes($height));
$speciality = trim(addslashes($speciality));
$email = trim(addslashes($email));
$qq = trim(addslashes($qq));
$phone_1 = trim(addslashes($phone_1));
$phone_2 = trim(addslashes($phone_2));
$phone_3 = trim(addslashes($phone_3));

if (!empty($weight) && !is_numeric($weight)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '体重需要是一个数字（kg）';
    echo json_encode($returnValue);
    exit();
}
if (!empty($height) && !is_numeric($height)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '高度需要是一个数字（cm）';
    echo json_encode($returnValue);
    exit();
}
if (!empty($email) && !isEmail($email)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请填写正确的 Email 地址';
    echo json_encode($returnValue);
    exit();
}
if (!empty($qq) && (!is_numeric($qq) || strlen($qq) < 5 || strlen($qq) > 12)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请填写正确的 QQ 号码';
    echo json_encode($returnValue);
    exit();
}
if (!empty($phone_1) && (!is_numeric($phone_1) || strlen($phone_1) != 11)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请填写正确的 “手机1” 的号码';
    echo json_encode($returnValue);
    exit();
}
if (!empty($phone_2) && (!is_numeric($phone_2) || strlen($phone_2) != 11)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请填写正确的 “手机2” 的号码';
    echo json_encode($returnValue);
    exit();
}
if (!empty($phone_3) && (!is_numeric($phone_3) || strlen($phone_3) != 11)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请填写正确的 “手机3” 的号码';
    echo json_encode($returnValue);
    exit();
}

try {
    global $nation, $weight, $height, $speciality, $email, $qq, $phone_1, $phone_2, $phone_3;
    
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `classmates` SET `nation`="'.$nation.'", `weight`="'.$weight.'", `height`="'.$height.'", `speciality`="'.$speciality.'", `email`="'.$email.'", `qq`= "'.$qq.'", `phone_1` = "'.$phone_1.'", `phone_2` = "'.$phone_2.'", `phone_3` = "'.$phone_3.'" WHERE `id`='.$_SESSION['userId'];
    $db->query($query);
    
    $returnValue['status'] = 'OK';
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>
