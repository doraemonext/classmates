<?php /* Smarty version Smarty-3.1.13, created on 2013-05-30 11:37:00
         compiled from "smarty/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86943349151a30635a882a2-01521467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '500bf49b2db79e84a4de92b818a79a85b01ab0c9' => 
    array (
      0 => 'smarty/header.tpl',
      1 => 1369884964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86943349151a30635a882a2-01521467',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a30635b3b031_42349139',
  'variables' => 
  array (
    'title' => 0,
    'navigationPage' => 0,
    'address' => 0,
    'name' => 0,
    'subtitle' => 0,
    'uid' => 0,
    'images_tourist' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a30635b3b031_42349139')) {function content_51a30635b3b031_42349139($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="templates/css/style.css">
        <link rel="stylesheet" type="text/css" href="templates/css/pic/style.css">               
        <script type="text/javascript" src="templates/js/jquery.js"></script>        
        <script type="text/javascript" src="templates/js/bootstrap.min.js"></script>     
        <script type="text/javascript" src="templates/js/picture/jquery.jDiaporama.js"></script>
        <script type="text/javascript" src="templates/js/picture/script.js"></script>
        <script type="text/javascript" src="templates/js/tools/scroll_content.js"></script>  
        <script type="text/javascript" src="templates/js/tools/validation.js"></script>  
        <script type="text/javascript" src="templates/js/classmates.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="./index.php"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</a>
                    <div class="nav-collapse collapse" id="main-menu">
                        <ul class="nav pull-left" id="main-menu-left">
                            <?php  $_smarty_tpl->tpl_vars['address'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['address']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigationPage']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['address']->key => $_smarty_tpl->tpl_vars['address']->value){
$_smarty_tpl->tpl_vars['address']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['address']->key;
?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
"><strong><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</strong></a></li>
                            <?php } ?>
                        </ul>
                        <div class="nav pull-right" id="main-menu-right">
                            <div class="scrollDiv" id="navigationMotto">
                                <!-- Javascript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
            
        <div class="container">
            <header class="jumbotron subhead" id="overview">
                <div class="row">
                    <div class="span7">
                        <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
                        <p class="lead"><?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>
</p>
                    </div>
                    <div class="span4">
                        <br />
                        <?php if ($_smarty_tpl->tpl_vars['uid']->value=='unknown'){?>
                            <div class="row">
                                <div class="span1">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['images_tourist']->value;?>
" class="thumbnail">
                                        <img src="images/tourist.png" />
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong>游客您好，您现在还没有登录<br /><br /></strong></p>
                                    <a data-toggle="modal" href="#loginModal" class="btn btn-success"> 登录</a>
                                    &nbsp;&nbsp;
                                    <a data-toggle="modal" href="#regModal" class="btn btn-primary"> 注册</a>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="row">
                                <div class="span1">
                                    <a href="#" class="thumbnail">
                                        <img id="headerUsernameAvatar" src="images/tourist.png" alt="">
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong><span id="headerUsername"></span>，欢迎您的使用<br /><br /></strong></p>
                                    <a class="btn btn-success" href="#"> 个人信息管理</a>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-primary" onclick="logout()"> 安全退出</a>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </header>
            <br/><?php }} ?>