<?php

/**
 * 文件说明：返回首页图片轮播右侧的文字
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/get_options.php';

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT * FROM `options`';
    $result = $db->query($query);
    while ($rows = $result->fetch_object()) {
    	if ($rows->options_name == "index_writing") {
    		$index_writing = $rows->options_value;
    		break;
    	}
    }
} catch (Exception $e) {
    echoException($e);
}

echo htmlspecialchars_decode($index_writing);

?>
