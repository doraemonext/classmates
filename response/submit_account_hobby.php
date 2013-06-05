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
        case 'account_books':
            $books = $submit[$i]['value'];
            break;
        case 'account_music':
            $music = $submit[$i]['value'];
            break;
        case 'account_movie':
            $movie = $submit[$i]['value'];
            break;
        case 'account_brands':
            $brands = $submit[$i]['value'];
            break;
        case 'account_sports':
            $sports = $submit[$i]['value'];
            break;
        case 'account_worship':
            $worship = $submit[$i]['value'];
            break;
        case 'account_others':
            $others = $submit[$i]['value'];
            break;
        default:
            $returnValue['status'] = 'ERROR';
            $returnValue['statusInfo'] = '系统处理提交数据时发生错误，请联系管理员解决';
            echo json_encode($returnValue);
            exit();
    }
}

try {
    global $books, $music, $movie, $brands, $sports, $worship, $others;
    
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'UPDATE `classmates` SET `hobby_books`="'.$books.'", `hobby_music`="'.$music.'", `hobby_movie`="'.$movie.'", `hobby_brands`="'.$brands.'", `hobby_sports`="'.$sports.'", `hobby_worship`= "'.$worship.'", `hobby_others` = "'.$others.'" WHERE `id`='.$_SESSION['userId'];
    $db->query($query);
    
    $returnValue['status'] = 'OK';
    echo json_encode($returnValue);
    exit();
} catch (Exception $e) {
    echoException($e);
}
?>
