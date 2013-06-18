<?php

/**
 * 文件说明：管理后台上传的图片接收操作
 * 
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../../config.php';
require_once dirname(__FILE__).'/../../functions.php';

require dirname(__FILE__).'/../../safe.php';
require dirname(__FILE__).'/../../tools/cookie.php';

$returnValue = array();

switch ($_SESSION['userPrivilege']) {
    case MEMBER_TOURIST:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，您尚未登陆或 Cookie 失效，请刷新本页面后重新登陆。';
        echo json_encode($returnValue);
        exit();
        break;
    case MEMBER_BANNED:
    case MEMBER_UNVERIFY:
    case MEMBER_NORMAL:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，您没有管理员权限，请联系管理员处理。';
        echo json_encode($returnValue);
        exit();
        break;
    case MEMBER_ADMIN:
        break;
    default:
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '对不起，发生未知错误，请联系管理员处理。';
        echo json_encode($returnValue);
        exit();
        break;
}

if ($_FILES['pictureNew']['error'] > 0) {
    $returnValue['status'] = 'ERROR';
    switch ($_FILES['pictureNew']['error']) {
        case 1:
            $returnValue['statusInfo'] = '文件大小超过 upload_max_filesize';
            break;
        case 2:
            $returnValue['statusInfo'] = '文件大小超过 MAX_FILE_SIZE';
            break;
        case 3:
            $returnValue['statusInfo'] = '文件未完全上传';
            break;
        case 4:
            $returnValue['statusInfo'] = '没有文件可以上传，请确定您已经选择了一张图片';
            break;
        case 6:
            $returnValue['statusInfo'] = '服务器不存在临时目录';
            break;
        case 7:
            $returnValue['statusInfo'] = '服务器不可写';
            break;
    }
    echo json_encode($returnValue);
    exit();
}

if ($_FILES['pictureNew']['type'] != 'image/gif' &&
    $_FILES['pictureNew']['type'] != 'image/jpeg' &&
    $_FILES['pictureNew']['type'] != 'image/pjpeg' &&
    $_FILES['pictureNew']['type'] != 'image/png') {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '您上传的文件不是图片类型，请检查后重试';
    echo json_encode($returnValue);
    exit();
}

if ($_FILES['pictureNew']['size'] > 4096000) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '您上传的图片大小超过了系统的最大限制，请缩放后重新上传';
    echo json_encode($returnValue);
    exit();    
}

$filename = md5_file($_FILES['pictureNew']['tmp_name']);
$upfile = dirname(__FILE__).'/../../images/index_picture/'.$filename.'.'.getExtension($_FILES['pictureNew']['name']);

if (is_uploaded_file($_FILES['pictureNew']['tmp_name'])) {
    if (file_exists($upfile)) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '当前图片轮播中已经有此张图片，请您选择其他图片上传';
        echo json_encode($returnValue);
        exit();    
    }
    if (!move_uploaded_file($_FILES['pictureNew']['tmp_name'], $upfile)) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '服务器无法将图片从临时文件夹移动到目标文件夹';
        echo json_encode($returnValue);
        exit();    
    }
} else {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '您选择的文件并非正常文件，请确定您的选择是否正确';
    echo json_encode($returnValue);
    exit();   
}

$finalFilename = 'images/index_picture/'.$filename.'.'.getExtension($_FILES['pictureNew']['name']);
try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'INSERT INTO index_picture(url) VALUES ( "'.$finalFilename.'" )';
    $db->query($query);
    
    if ($db->affected_rows != 1) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '将图片路径插入数据库时发生错误';
        echo json_encode($returnValue);
        exit();  
    }
} catch (Exception $e) {
    echoException($e);
}

$returnValue['status'] = "OK";
echo json_encode($returnValue);

?>

