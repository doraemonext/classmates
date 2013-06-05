<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">管理后台</li>
    </ul>
    {if $isDisplay == "true"}
        {if $isAdmin == "false"}
            <div class="alert alert-error">
                非常抱歉，您不具有管理员资格。
            </div>
        {else}
        <div class="row">
            <div class="span3">
                <div class="sidebar-nav">
                    <div class="well" style="padding: 8px 0;">
                        <ul class="nav nav-list">
                            <h4 style="text-align: center;">管理后台</h4>
                            <li class="nav-header">全站设置</li>
                            <li><a href="#" onclick="adminChangeToBasic()"><i class="icon-thumbs-up"></i> 站点设置</a></li>
                            <li><a href="#" onclick="adminChangeToUser()"><i class="icon-envelope"></i> 用户管理</a></li>
                        </ul>
                    </div>
                </div>
            </div>    
            <div class="span8" id="admin_basic"></div>
            <div class="span8" id="admin_detail"></div>
        </div>
        <script type="text/javascript">
            $(function() { adminChangeToBasic(); });
        </script>
        {/if}
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