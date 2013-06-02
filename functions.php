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

/*
 * 显示头部 HTML 内容
 */
function showHeader($title, $subtitle, $pageLocated, $uid)
{
    global $_config;
    
    $ui = getNewSmarty();
    $navigationPage = array(
        $_config['page']['classmates'] => 'classmates',
        $_config['page']['show_picture'] => 'show_picture',
        $_config['page']['show_video'] => 'show_video',
        $_config['page']['timeaxis'] => 'timeaxis'
    );
    
    $ui->assign('title', $title);
    $ui->assign('subtitle', $subtitle);
    $ui->assign('navigationPage', $navigationPage);
    $ui->assign('uid', $uid);
    $ui->assign('pageLocated', $pageLocated);
    
    $ui->display('header.tpl');
}

/*
 * 显示底部 HTML 内容
 */
function showFooter($title)
{
    $ui = getNewSmarty();
    
    $ui->assign('title', $title);
    
    $ui->display('footer.tpl');
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

function getOption($_options, $name) {
    while ($row = $_options->fetch_object()) {
        if ($row->options_name == $name) {
            return $row->options_value;
        }
    }
    throw new Exception("程序取得了一个无效选项", GET_OPTIONS_ERROR);
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

?>
