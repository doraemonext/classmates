<link rel="stylesheet" type="text/css" href="libs/datetimepicker/datetimepicker.css">
<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="libs/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>

<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">个人信息管理</li>
    </ul>
    {if $isDisplay == "true"}
        <div class="row">
            <div class="span3">
                <div class="sidebar-nav">
                    <div class="well" style="padding: 8px 0;">
                        <ul class="nav nav-list">
                            <h4 style="text-align: center;">管理中心</h4>
                            <li class="nav-header">个人资料</li>
                            <li><a href="#" onclick="accountChangeToBasic()"><i class="icon-thumbs-up"></i> 基本资料</a></li>
                            <li><a href="#" onclick="accountChangeToDetail()"><i class="icon-envelope"></i> 详细资料</a></li>
                            <li><a href="#" onclick="accountChangeToHobby()"><i class="icon-list-alt"></i> 兴趣爱好</a></li>
                            <li><a href="#" onclick="accountChangeToAvatar({$userId})"><i class="icon-eye-close"></i> 个人头像</a></li> 
                            <li class="divider"></li>
                            <li class="nav-header">账户安全</li>
                            <li><a href="#" onclick="accountChangeToPassword()"><i class="icon-qrcode"></i> 密码修改</a></li>
                            <li><a href="#" onclick="logout()"><i class="icon-share"></i> 安全退出</a></li>
                        </ul>
                    </div>
                </div>
            </div>    
            <div class="span8" id="account_content_basic"></div>
            <div class="span8" id="account_content_detail"></div>
            <div class="span8" id="account_content_hobby"></div>
            <div class="span8" id="account_content_avatar_all">
                <div id="account_content_avatar"></div>
                <div id="account_content_avatar_upload"></div>
            </div>
            <div class="span8" id="account_password"></div>
        </div>
        <script type="text/javascript">
            $(function() { accountChangeToBasic(); });
        </script>
    {else}
        <div class="row">
            <div class="span12">
                <div class="alert alert-error">
                    <i class="icon-exclamation-sign"></i> 您还没有登录，请登陆后再访问此页面。
                </div> 
            </div>
        </div>
    {/if}
</div>