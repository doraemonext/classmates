<?php

/**
 * 文件说明：返回“个人信息管理”页面的“头像设置“
 * 
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$_SESSION['userId'] = intval($_SESSION['userId']);

$returnValue = array();

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

$returnValue['status'] = 'OK';

$avatar = getAvatarPath($_SESSION['userId']);
if ($avatar != 'images/tourist.png') {
    $returnValue['exist'] = true;
    $returnValue['path'] = $avatar.'?sid='.rand();
} else {
    $returnValue['exist'] = false;
    $returnValue['path'] = $avatar;
}

echo json_encode($returnValue);    
?>

