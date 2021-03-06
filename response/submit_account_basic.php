<?php

/**
 * 文件说明：提交“个人信息管理”页面的“基本信息给数据库
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$returnValue = array();
$submit = json_decode($_POST['json'], true);

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

for ($i = 0; $i < count($submit); $i++) {
    switch ($submit[$i]['name']) {
        case 'account_sex':
            $sex = $submit[$i]['value'];
            break;
        case 'account_birthday':
            $birthday = $submit[$i]['value'];
            break;
        case 'account_blood_type':
            $bloodType = $submit[$i]['value'];
            break;
        case 'account_residence':
            $residence = $submit[$i]['value'];
            break;
        case 'account_give_others':
            $giveOthers = $submit[$i]['value'];
            break;
        default:
            $returnValue['status'] = 'ERROR';
            $returnValue['statusInfo'] = '系统处理提交数据时发生错误，请联系管理员解决';
            echo json_encode($returnValue);
            exit();
    }
}

$sex = addslashes($sex);
$birthday = addslashes($birthday);
$bloodType = addslashes($bloodType);
$residence = addslashes($residence);
$giveOthers = addslashes($giveOthers);

$unknownInput = false;

if ($sex == 'man') {
    $sex = 0;
} else if ($sex == 'woman') {
    $sex = 1;
} else {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '性别只能选择“男”或“女”';
    echo json_encode($returnValue);
    exit();
}

if (!isDate($birthday)) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请您输入一个正确的日期';
    echo json_encode($returnValue);
    exit();
}

if (!is_numeric($bloodType) || $bloodType < 0 || $bloodType > 5) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '请您选择一个正确的血型';
    echo json_encode($returnValue);
    exit();
}

try {
    global $sex, $birthday, $bloodType, $residence, $giveOthers;
    
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `classmates` SET `sex`='.$sex.', `birthday`="'.$birthday.'", `blood_type`='.$bloodType.', `residence`="'.$residence.'", `give_others`="'.$giveOthers.'" WHERE `id`='.$_SESSION['userId'];
    $db->query($query);
    
    $returnValue['status'] = 'OK';
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>
