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

@ $id = $_GET['id'];

$isDisplay = "true";
if (!isset($_SESSION['userCookie'])) {
    $isDisplay = "false";
}
if (empty($id)) {
    $isDisplay = "false";
}
if (!is_numeric($id)) {
    $isDisplay = "false";
}

// 取得标题和副标题信息
try {
    $title = getOption($_options, 'title');
    $subtitle = getOption($_options, 'subtitle');
} catch (Exception $e) {
    echoException($e);
}

$data = array();

if ($isDisplay == "true") {
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT * FROM `classmates` WHERE `id` = '.$id;
        $result = $db->query($query);
        if ($result->num_rows == 0) {
            $isDisplay = "false";
        }
    } catch (Exception $e) {
        echoException($e);
    }
}

if ($isDisplay == "true") {    
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
    $data['hobby'] = $rows->hobby;
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

// 显示头部
if (isset($_SESSION['userCookie'])) {
    showHeader($title, $subtitle, $pageLocated, 'known');
} else {
    showHeader($title, $subtitle, $pageLocated, 'unknown');
}

$ui = getNewSmarty();
$ui->assign('title', $title);
$ui->assign('subtitle', $subtitle);
$ui->assign('pageLocated', $pageLocated);
$ui->assign('isDisplay', $isDisplay);
$ui->assign('data', $data);
$ui->display('account_detail.tpl');

// 显示底部
showFooter($title);

?>
