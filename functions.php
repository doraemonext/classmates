<?php
/**
 * 文件说明：为 Classmates 提供必要的函数支持
 *
 * @author     Doraemonext
 */

/*
 * 得到一个新的 Smarty 变量，并做好初始化工作
 */
function getNewSmarty() 
{
    $ui = new Smarty;
    
    $ui->setCompileDir("smarty_compile");
    $ui->setTemplateDir("smarty");
    $ui->setCacheDir("cache");
    $ui->setConfigDir("configs");
    //$ui->debugging = true;
    $ui->assign('pageLocated', 'UNKNOWN');
    
    return $ui;
}

function getOption($_options, $name) {
    while ($row = $_options->fetch_object()) {
        if ($row->options_name == $name) {
            return $row->options_value;
        }
    }
    throw new Exception("程序取得了一个无效选项", GET_OPTIONS_ERROR);
}

function getPageBasicInfo() {
    global $_config;
    $info = array();
    
    try {
        $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                           $_config['db']['password'], $_config['db']['dbname']);
        $query = 'SET NAMES UTF8';
        $db->query($query);
        $query = 'SELECT * FROM `options`';
        $options = $db->query($query);
        
        while ($rows = $options->fetch_object()) {
            $info[$rows->options_name] = $rows->options_value;
        }
    } catch (Exception $e) {
        echoException($e);
    }
    
    $info['navigationPage'] = array(
        $_config['page']['classmates'] => 'classmates',
        $_config['page']['show_picture'] => 'show_picture',
        $_config['page']['show_video'] => 'show_video'
    );
    
    return $info;
}

/*
 * 连接数据库的初始化工作
 */
function mysqlConnect($host, $username, $password, $dbname) 
{
    @ $db = new mysqli($host, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
        throw new Exception("连接数据库时发生错误", MYSQL_ERROR);
        exit;
    }
    return $db;
}

/*
 * 打印异常信息（直接打开error.php页面并显示）
 */
function echoException($e) 
{
    $code = $e->getCode();
    $msg = $e->getMessage();
    $file = $e->getFile();
    $line = $e->getLine();
    echo '<meta http-equiv=refresh content=0;url="error.php?code='.$code.'&msg='.$msg.'&file='.$file.'&line='.$line.'">';
}

/*
 * 输出error log文件
 */
function printLog($log) 
{
    file_put_contents('error.log', date("Y-m-d H:i:s"). " " . $log. "\r\n", FILE_APPEND | LOCK_EX);
}

/*
 * 获取头像信息
 */
function getAvatarPath($id) {
    chdir(dirname(__FILE__));
    
    $id = sprintf("%09d", $id);
    $path = 'images/avatar/'.substr($id, 0, 3).'/'.substr($id, 3, 2).'/'.substr($id, 5, 2).'/'.substr($id, 7, 2).'_avatar_middle.jpg';
    if (file_exists($path)) {
        return $path;
    } else {
        return 'images/tourist.png';
    }
}

/*
 * Cookie加密解密算法
 */
function encrypt($decStr, $strKey)
{
    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $strKey, $decStr, MCRYPT_MODE_ECB));
}  
function decrypt($encStr, $strKey)
{
    return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $strKey, base64_decode($encStr), MCRYPT_MODE_ECB);
}

function checkPassword($password, $salt, $database_password) {
    if (md5($database_password.$salt) == $password) {
        return true;
    } else {
        return false;
    }
}

function curPageURL()
{
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function unescape($str) 
{ 
    $ret = ''; 
    $len = strlen($str); 
    for ($i = 0; $i < $len; $i ++) 
    { 
        if ($str[$i] == '%' && $str[$i + 1] == 'u') 
        { 
            $val = hexdec(substr($str, $i + 2, 4)); 
            if ($val < 0x7f) 
                $ret .= chr($val); 
            else  
                if ($val < 0x800) 
                    $ret .= chr(0xc0 | ($val >> 6)) . 
                     chr(0x80 | ($val & 0x3f)); 
                else 
                    $ret .= chr(0xe0 | ($val >> 12)) . 
                     chr(0x80 | (($val >> 6) & 0x3f)) . 
                     chr(0x80 | ($val & 0x3f)); 
            $i += 5; 
        } else  
            if ($str[$i] == '%') 
            { 
                $ret .= urldecode(substr($str, $i, 3)); 
                $i += 2; 
            } else 
                $ret .= $str[$i]; 
    } 
    return $ret; 
} 

function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') { 
    $return = ''; 
    if (function_exists('mb_get_info')) { 
        for($x = 0; $x < mb_strlen ( $string, $in_encoding ); $x ++) { 
            $str = mb_substr ( $string, $x, 1, $in_encoding ); 
            if (strlen ( $str ) > 1) { 
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) ); 
            } else { 
                $return .= '%' . strtoupper ( bin2hex ( $str ) ); 
            } 
        } 
    } 
    return $return; 
} 

/*
 * 检查是否是正确的日期
 */
function isDate($str, $format='Y-m-d'){
	$unixTime_1 = strtotime($str);
	if (!is_numeric($unixTime_1)) 
        return false; 
	$checkDate = date($format, $unixTime_1);
	$unixTime_2 = strtotime($checkDate);
	if ($unixTime_1 == $unixTime_2) {
		return true;
	} else {
		return false;
	}
}

/*
 * 检查是否是正确的Email地址
 */
function isEmail($email){
	if (preg_match("/^[0-9a-zA-Z\_]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i", $email)) {
    	return true;
    } else {
        return false;
	}
}

/*
 * 获取文件扩展名
 */
function getExtension($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}

/*
 * 制作缩略图
 */
function createThumbnail($srcFile, $toW, $toH, $toFile="")   
{  
    if ($toFile == "") {   
        $toFile = $srcFile;   
    }  
    $info = "";  
    //返回含有4个单元的数组，0-宽，1-高，2-图像类型，3-宽高的文本描述。  
    //失败返回false并产生警告。  
    $data = getimagesize($srcFile, $info);  
    if (!$data)  
        return false;  

    //将文件载入到资源变量im中  
    switch ($data[2])  { //1-GIF，2-JPG，3-PNG  
        case 1:  
            if(!function_exists("imagecreatefromgif")) {  
                echo "the GD can't support .gif, please use .jpeg or .png! <a href='javascript:history.back();'>back</a>";  
                exit();  
            }  
            $im = imagecreatefromgif($srcFile);  
            break;  
        case 2:  
            if(!function_exists("imagecreatefromjpeg")) {  
                echo "the GD can't support .jpeg, please use other picture! <a href='javascript:history.back();'>back</a>";  
                exit();  
            }  
            $im = imagecreatefromjpeg($srcFile);  
            break;  
        case 3:  
            $im = imagecreatefrompng($srcFile);      
            break;  
    }  

    //计算缩略图的宽高  
    $srcW = imagesx($im);  
    $srcH = imagesy($im);  
    $toWH = $toW / $toH;  
    $srcWH = $srcW / $srcH;  
    if ($toWH <= $srcWH) {  
        $ftoW = $toW;  
        $ftoH = (int)($ftoW * ($srcH / $srcW));  
    } else {  
        $ftoH = $toH;  
        $ftoW = (int)($ftoH * ($srcW / $srcH));  
    }  
    if (function_exists("imagecreatetruecolor")) {  
        $ni = imagecreatetruecolor($ftoW, $ftoH); //新建一个真彩色图像  
        if ($ni) {  
            //重采样拷贝部分图像并调整大小 可保持较好的清晰度  
            imagecopyresampled($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);  
        } else {  
            //拷贝部分图像并调整大小  
            $ni = imagecreate($ftoW, $ftoH);  
            imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);  
        }  
    } else {  
        $ni = imagecreate($ftoW, $ftoH);  
        imagecopyresized($ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH);  
    }  

    //保存到文件 统一为.png格式  
    imagejpeg($ni, $toFile, 80); //以 PNG 格式将图像输出到浏览器或文件  
    ImageDestroy($ni);  
    ImageDestroy($im);  
    return true;  
}  

?>
