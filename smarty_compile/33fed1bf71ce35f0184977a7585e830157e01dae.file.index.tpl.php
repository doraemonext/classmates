<?php /* Smarty version Smarty-3.1.13, created on 2013-05-31 10:36:50
         compiled from "smarty/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24041766851a217c4ea4903-46274097%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33fed1bf71ce35f0184977a7585e830157e01dae' => 
    array (
      0 => 'smarty/index.tpl',
      1 => 1369962512,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24041766851a217c4ea4903-46274097',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51a217c4eeede1_20960214',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51a217c4eeede1_20960214')) {function content_51a217c4eeede1_20960214($_smarty_tpl) {?><div class="container">
    <div class="white_framework">
        <div class="row">
            <div class="span6">
                <div id="pic_carousel" class="carousel slide">
                    <ol class="carousel-indicators" id="index_picture_navigation">
                        <li data-target="#pic_carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#pic_carousel" data-slide-to="1"></li>
                        <li data-target="#pic_carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" id="index_picture_url">
                        <div class="active item"><img src="images/galerie/image1.jpg"/></div>
                        <div class="item"><img src="images/galerie/image2.jpg"/></div>
                        <div class="item"><img src="images/galerie/image3.jpg"/></div>
                    </div>
                    <a class="carousel-control left" href="#pic_carousel" data-slide="prev"></a>
                    <a class="carousel-control right" href="#pic_carousel" data-slide="next"></a>
                </div>
            </div>
            <div class="span5" id="index_writing">
                <!-- Javascript -->
            </div>
            <br/>
        </div>
    </div>
</div>
    
<!-- 登录窗口 -->
<div style="display: none;" id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel" class="well">登录</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="login_info" style="display: none;">
            <!--显示登录进度-->
        </div>
        <form class="form-horizontal" name="loginForm" id="loginForm" action='' method="POST">
            <fieldset>
                <div class="control-group"></div>
                <div class="control-group">
                    <label class="control-label" for="username">姓名</label>
                    <div class="controls">
                        <input type="text" id="login_username" name="login_username" placeholder="" value="" class="input-large"
                               maxlength="5" minlength="2"
                               data-validation-minlength-message = "姓名最少为2个汉字"
                               data-validation-maxlength-message = "姓名最多为5个汉字"
                               required/>
                    </div>
                </div>
                    
                <div class="control-group">
                    <label class="control-label" for="password">密码</label>
                    <div class="controls">
                        <input type="password" id="login_password" name="login_password" placeholder="" class="input-large"
                               maxlength="30" minlength="3"
                               data-validation-minlength-message="密码最少为3个字符"
                               data-validation-maxlength-message="密码最多为30个字符"
                               required/>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls row">
                        <div class="span1">
                            <button class="btn btn-primary" type="button" onclick="displayLoginInfo()">提交</button>
                        </div>
                        <div class="span2">
                            <button class="btn btn-warning" type="button">忘记密码？</button>                            
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
        
</div>
    
<!-- 注册窗口 -->
<div style="display: none;" id="regModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel" class="well">注册</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info" id="register_info" style="display: none;">
            <!--显示注册进度-->
        </div>
        <form class="form-horizontal" action='' method="POST">
            <fieldset>
                <div class="control-group"></div>
                <div class="control-group">
                    <label class="control-label" for="username">姓名</label>
                    <div class="controls">
                        <input type="text" id="reg_username" name="reg_username" placeholder="" class="input-large"
                               maxlength="5" minlength="2"
                               data-validation-minlength-message="姓名最少为2个汉字"
                               data-validation-maxlength-message="姓名最多为5个汉字"
                               required/>
                        <p class="help-block">请填写<strong>真实姓名</strong>，经验证方可使用全部功能</p>
                    </div>
                </div>
                    
                <div class="control-group">
                    <label class="control-label" for="password">密码</label>
                    <div class="controls">
                        <input type="password" id="reg_password" name="reg_password" placeholder="" class="input-large"
                               maxlength="30" minlength="3"
                               data-validation-minlength-message="密码最少为3个字符"
                               data-validation-maxlength-message="密码最多为30个字符"
                               required/>
                        <p class="help-block">3 ~ 30位，不得有特殊字符</p>
                    </div>
                </div>
                    
                <div class="control-group">
                    <label class="control-label" for="password_confirm">密码确认</label>
                    <div class="controls">
                        <input type="password" id="reg_password_confirm" name="reg_password_confirm" placeholder="" class="input-large"
                               data-validation-match-match="reg_password"
                               data-validation-match-message="两次输入的密码不匹配"
                               maxlength="30" minlength="3"
                               data-validation-minlength-message="密码最少为3个字符"
                               data-validation-maxlength-message="密码最多为30个字符"
                               required/>
                        <p class="help-block">请再次确认您刚才输入的密码</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls row">
                        <div class="span2">
                            <button class="btn btn-primary btn-block" type="button" onclick="register()">提交注册信息</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>    
<?php }} ?>