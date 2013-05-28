<?php

/**
 * 文件说明：为首页右上角的励志话语提供数据库查询
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';

$return_value = array();
@ $db = new mysqli($_config['db']['host'], $_config['db']['username'], 
                   $_config['db']['password'], $_config['db']['dbname']);

if (mysqli_connect_errno()) {
    array_push($return_value, '数据库读取错误');
    array_push($return_value, '请联系管理员进行维护');
    echo json_encode($return_value);
    exit;
}

$query = 'SET NAMES UTF8';
$db->query($query);
$query = 'SELECT `content` FROM `index_motto` ORDER BY `id`';
$result = $db->query($query);

while ($row = $result->fetch_object()) {
    array_push($return_value, $row->content);
}

echo json_encode($return_value);
?>
