<?php /* Smarty version Smarty-3.1.13, created on 2013-05-28 07:35:19
         compiled from "smarty/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24041766851a217c4ea4903-46274097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33fed1bf71ce35f0184977a7585e830157e01dae' => 
    array (
      0 => 'smarty/index.tpl',
      1 => 1369697703,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24041766851a217c4ea4903-46274097',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a217c4eeede1_20960214',
  'variables' => 
  array (
    'title' => 0,
    'subtitle' => 0,
    'validUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a217c4eeede1_20960214')) {function content_51a217c4eeede1_20960214($_smarty_tpl) {?><div class="container">
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
                    <?php if ($_smarty_tpl->tpl_vars['validUser']->value==''){?>
                        <div class="row">
                            <div class="span1">
                                <a href="images/tourist.png" class="thumbnail">
                                    <img src="images/tourist.png" alt="">
                                </a>
                            </div>
                            <div class="span3">
                                <p><strong>游客您好，您现在还没有登录<br /><br /></strong></p>
                                <a class="btn btn-success" href="#"> 登录</a>
                                &nbsp;&nbsp;
                                <a class="btn btn-primary" href="#"> 注册</a>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="span1">
                                <a href="images/tourist.png" class="thumbnail">
                                    <img src="images/tourist.png" alt="">
                                </a>
                            </div>
                            <div class="span3">
                                <p><strong><?php echo $_smarty_tpl->tpl_vars['validUser']->value;?>
 您好，欢迎您的使用<br /><br /></strong></p>
                                <a class="btn btn-success" href="#"> 个人信息管理</a>
                                &nbsp;&nbsp;
                                <a class="btn btn-primary" href="#"> 安全退出</a>
                            </div>
                        </div>
                    <?php }?>
            </div>
        </div>
    </header>
    <br/>
    
    <div class="white_framework">
        <div class="row">
            <div class="span7">
                <ul class="diaporama1" id="index_picture_show">
                    <!--<li><img src="images/galerie/image1.jpg" alt="On the road again" title="Sur la route de l'ouest, Arizona &copy; Guillaume Voisin" /></li>-->
                </ul>
                <br />
            </div>
            <div class="span4" id="index_writing">
                <!--<h4>
                    <br />
                    <br />
                    <p>长缨高冠，全宇轩昂意气扬</p>
                    <br />
                    <p>铁刃钢枪，驰骋疆场何人挡</p>
                    <br />
                    <p>狼毫软笔，尤飞凤舞书华章</p>
                    <br />
                    <p>448班，宏志高歌定称王！</p>
                    <br />
                    <p align="right">——孙胜扬</p>
                </h4>-->
            </div>
            <br/>
        </div>
    </div>
    
    <ul class="breadcrumb" id="index_breadcrumb">
        <!--<li><a href="#">首页</a> <span class="divider">/</span></li>
        <li><a href="#">同学录</a> <span class="divider">/</span></li>
        <li class="active">预览</li>-->
    </ul>
    
    <div class="row">
        <div class="span8">
            <div class="page-header">
                <h3>同学录一览</h3>
            </div>
            <div class="row" id="index_classmates">
                <!--<div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>-->
            <div class="pagination" id="index_pagination">
                <!--<ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Next</a></li>
                </ul>-->
            </div>
        </div>
        <div class="span4">
            <div class="page-header">
                <h3>最新公告</h3>
            </div>
            <div class="well" id="index_announcement">
                <!--详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                <br />
                详细信息详细信息详细信息详细信息xxx
                -->
            </div>
            <div class="page-header">
                <h3>留言板</h3>
            </div>
            <div id="index_message">
                <!--<p>我说了一句猥琐的话</p>
                <p align="right">——郭耀星</p>
                <br />-->
            </div>
            <div class="controls">
                <strong>你有什么想说的？</strong>
                <br />
                <br />
                <textarea class="input-xlarge" id="textarea" rows="5" ></textarea>
                <a class="btn btn-primary" href="#" >提交</a>
            </div>
        </div>
    </div>
    <hr />
</div>
<?php }} ?>