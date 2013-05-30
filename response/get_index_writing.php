<?php

/**
 * 文件说明：返回首页图片轮播右侧的文字
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../tools/get_options.php';

try {
    $index_writing = getOption($_options, 'index_writing');
} catch (Exception $e) {
    echoException($e);
}

echo $index_writing;

?>
