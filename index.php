<?php

require_once dirname(__FILE__).'/config.php';
require_once dirname(__FILE__).'/functions.php';

require dirname(__FILE__).'/safe.php';
require dirname(__FILE__).'/tools/get_options.php';
require dirname(__FILE__).'/tools/cookie.php';

$pageLocated = 'index';

$ui = getNewSmarty();
$ui->assign('basicInfo', getPageBasicInfo());
$ui->assign('userPrivilege', $_SESSION['userPrivilege']);
$ui->assign('pageLocated', $pageLocated);

$ui->display('index.tpl');

?>