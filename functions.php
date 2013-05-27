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
    // $ui->debugging = false;
    $ui->assign('pageLocated', 'UNKNOWN');
    
    return $ui;
}

/*
 * 显示头部 HTML 内容
 */
function showHeader($title, $subtitle)
{
    $ui = getNewSmarty();
    $navigationPage = array(
        '同学录' => 'classmates.php',
        '精彩瞬间' => 'show_picture.php',
        '视频掠影' => 'show_video.php',
        '时间轴' => 'timeaxis.php'
        );
    
    $ui->assign('title', $title);
    $ui->assign('subtitle', $subtitle);
    $ui->assign('navigationPage', $navigationPage);
    
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

?>
