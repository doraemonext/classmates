{include file="header.tpl" basicInfo=$basicInfo userPrivilege=$userPrivilege}
<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">管理后台</li>
    </ul>
    <div class="alert alert-error">
        {$errorInfo}
    </div>
</div>
{include file="footer.tpl" basicInfo=$basicInfo}