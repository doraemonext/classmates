<?php

/**
 * 文件说明：同学录详细信息页面
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';
require dirname(__FILE__).'/tools/get_options.php';
require dirname(__FILE__).'/tools/cookie.php';

$pageLocated = 'account_detail';

$isDisplay = $errorInfo = '';
switch ($_SESSION['userPrivilege']) {
    case MEMBER_TOURIST:
        $isDisplay = false;
        $errorInfo = '您尚未登陆，请登陆后重试。';
        break;
    case MEMBER_BANNED:
        $isDisplay = false;
        $errorInfo = '您的帐号已被管理员禁止，无法查看本页面。<br /><br />';
        $errorInfo .= '下面是管理员禁止您帐号的原因：<br /><br />';
        $errorInfo .= '<strong>'.$_SESSION['bannedReason'].'</strong><br /><br />';
        $errorInfo .= '如果您对此原因有任何异议，请联系管理员处理。';
        break;
    case MEMBER_UNVERIFY:
        $isDisplay = false;
        $errorInfo = '您尚未通过验证，请耐心等待管理员审核您的信息。<br />在审核通过之前，您只能修改自己的资料，而不能查看其他人的信息。';
        break;
    case MEMBER_NORMAL:
        $isDisplay = true;
        $errorInfo = '';
        break;
    case MEMBER_ADMIN:
        $isDisplay = true;
        $errorInfo = '';
        break;
    default:
        $isDisplay = false;
        $errorInfo = '发生未知错误，请联系管理员处理';
        break;
}

@ $id = $_GET['id'];
if (empty($id) || !is_numeric($id)) {
    $isDisplay = false;
    $errorInfo = '您提供的编号非法，请确认您是否从正确的页面点击进入。';
}

$data = array();

if ($isDisplay) {
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT * FROM `classmates` WHERE `id` = '.$id;
        $result = $db->query($query);
        if ($result->num_rows == 0) {
            $isDisplay = false;
            $errorInfo = '您提供的编号非法，请确认您是否从正确的页面点击进入。';
        }
    } catch (Exception $e) {
        echoException($e);
    }
}
 
if ($isDisplay) {
    $rows = $result->fetch_object();
    $data['name'] = $rows->name;
    $data['avatar'] = getAvatarPath($rows->id);
    $data['birthday'] = $rows->birthday;
    $data['sex'] = $rows->sex;
    if ($data['sex'] == 0) {
        $data['sex'] = '男';
    } else {
        $data['sex'] = '女';
    }
    $data['nation'] = $rows->nation;
    $data['weight'] = $rows->weight;
    $data['height'] = $rows->height;
    $data['phone_1'] = $rows->phone_1;
    $data['phone_2'] = $rows->phone_2;
    $data['phone_3'] = $rows->phone_3;
    $data['qq'] = $rows->qq;
    $data['speciality'] = $rows->speciality;
    $data['give_others'] = nl2br(str_replace(' ','&nbsp;', $rows->give_others));
    $data['residence'] = $rows->residence;
    $data['blood_type'] = $rows->blood_type;
    switch ($data['blood_type']) {
        case '0':
            $data['blood_type'] = '未知';
            break;
        case '1':
            $data['blood_type'] = 'A';
            break;
        case '2':
            $data['blood_type'] = 'B';
            break;
        case '3':
            $data['blood_type'] = 'O';
            break;
        case '4':
            $data['blood_type'] = 'AB';
            break;
        case '5':
            $data['blood_type'] = '其他';
            break;
    }
    $data['email'] = $rows->email;
    $data['hobby_books'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_books));
    $data['hobby_music'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_music));
    $data['hobby_movie'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_movie));
    $data['hobby_sports'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_sports));
    $data['hobby_brands'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_brands));
    $data['hobby_worship'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_worship));
    $data['hobby_others'] = nl2br(str_replace(' ','&nbsp;', $rows->hobby_others));
}

$ui = getNewSmarty();
$ui->assign('basicInfo', getPageBasicInfo());
$ui->assign('userPrivilege', $_SESSION['userPrivilege']);
$ui->assign('pageLocated', $pageLocated);

$ui->assign('isDisplay', $isDisplay);
$ui->assign('errorInfo', $errorInfo);
$ui->assign('data', $data);

$ui->display('account_detail.tpl');

?>
