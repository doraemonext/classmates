<link rel="stylesheet" type="text/css" href="libs/datetimepicker/datetimepicker.css">
<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>

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
                        <input type="text" id="account_nation" value="">
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
