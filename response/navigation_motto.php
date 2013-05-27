<?php

/**
 * 文件说明：为首页右上角的励志话语提供数据库查询
 *
 * @author     Doraemonext
 */

require '../config.php';

@ $db = new mysqli($_config['db']['host'], $_config['db']['username'], 
                   $_config['db']['password'], $_config['db']['dbname']);
if (mysqli_connect_errno()) {
    echo '<li>数据库读取错误</li><li>请联系管理员进行维护</li>';
    exit;
}

$query = 'SET NAMES UTF8';
$db->query($query);
$query = 'SELECT `content` FROM `index_motto` ORDER BY `id`';
$result = $db->query($query);
$return_value = "";

while ($row = $result->fetch_object()) {
    $return_value .= '<li>' . $row->content . '</li>';
}

echo addslashes($return_value);
?>
