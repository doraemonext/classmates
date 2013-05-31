<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="libs/datetimepicker/datetimepicker.css">

<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">个人信息管理</li>
    </ul>
    <div class="row">
        <div class="span3">
            <div class="sidebar-nav">
                <div class="well" style="padding: 8px 0;">
                    <ul class="nav nav-list">
                        <h4 style="text-align: center;">管理中心</h4>
                        <li class="nav-header">个人资料</li>
                        <li><a href="#" onclick="accountChangeToBasic()"><i class="icon-home"></i> 基本资料</a></li>
                        <li><a href="#"><i class="icon-envelope"></i> 详细资料</a></li>
                        <li><a href="#"><i class="icon-envelope"></i> 兴趣爱好</a></li>
                        <li><a href="#"><i class="icon-envelope"></i> 个人图片</a></li>                        
                        <li class="divider"></li>
                        <li class="nav-header">账户安全</li>
                        <li><a href="#"><i class="icon-qrcode"></i> 密码修改</a></li>
                        <li><a href="#" onclick="logout()"><i class="icon-share"></i> 安全退出</a></li>
                    </ul>
                </div>
            </div>
        </div>            
        <div style="display: none">
                民族，体重，身高，专业，手机，QQ，Email<br/>
                书籍，音乐，电影，运动，品牌，欣赏的人，其他爱好
        </div>
        <div class="span8" id="account_content">
            <div class="page-header">
                <h3>详细资料 <small>本页资料均可选填</small></h3>
            </div>
            <form class="form-horizontal span8">
                <div class="control-group">
                    <label class="control-label">民族</label>
                    <div class="controls">
                        <input type="text" id="account_nation" value="" data-validation-minlength-message = "姓名最少为2个汉字">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">体重</label>
                    <div class="controls">
                        <input type="text" id="account_weight" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">身高</label>
                    <div class="controls">
                        <input type="text" id="account_height" value="">
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">专业</label>
                    <div class="controls">
                        <input type="text" id="account_speciailty" value="">
                        <span class="help-block"></span>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                        <input type="text" id="account_email" value="">
                        <span class="help-block"></span>
                    </div>
                </div>       
                <div class="control-group">
                    <label class="control-label">QQ</label>
                    <div class="controls">
                        <input type="text" id="account_qq" value="">
                        <span class="help-block"></span>
                    </div>
                </div>        
                <div class="control-group">
                    <label class="control-label">手机 1</label>
                    <div class="controls">
                        <input type="text" id="account_phone_1" value="">
                        <span class="help-block"></span>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label">手机 2</label>
                    <div class="controls">
                        <input type="text" id="account_phone_2" value="">
                        <span class="help-block"></span>
                    </div>
                </div>    
                <div class="control-group">
                    <label class="control-label">手机 3</label>
                    <div class="controls">
                        <input type="text" id="account_phone_3" value="">
                        <span class="help-block"></span>
                    </div>
                </div>          
                <div class="control-group">
                    <div class="controls row">
                        <div class="span2">
                            <button class="btn btn-primary btn-block" type="button" onclick="submitAccountDetail()">提交修改</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
//    accountChangeToBasic();
</script>

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

<div id="account_submit_success" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">修改成功</h3>
    </div>
    <div class="modal-body">
        <p class="alert alert-success">您的信息已成功修改。</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true" onclick="window.location.reload();">关闭</button>
    </div>
</div>