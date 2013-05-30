<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        {if $pageLocated == 'index'}
            <li class="active">首页 <span class="divider">/</span></li>
        {else}
            <li><a href="index.php">首页</a> <span class="divider">/</span></li>
            {if $pageLocated == 'classmates'}
                <li class="active">同学录</li>
            {elseif $pageLocated == 'show_picture'}
                <li class="active">精彩瞬间</li>
            {elseif $pageLocated == 'show_video'}
                <li class="active">视频掠影</li>
            {elseif $pageLocated == 'timeaxis'}
                <li class="active">时间轴</li>
            {/if}
        {/if}
    </ul>
        
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h3>同学录一览</h3>
            </div>
            <div class="row" id="index_classmates">
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
            <div class="pagination" id="index_pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr />
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
                        <p class="help-block">5 ~ 20位，不得有特殊字符</p>
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
<!-- div container 在footer.tpl关闭 -->    