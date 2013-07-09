{include file="header.tpl" basicInfo=$basicInfo userPrivilege=$userPrivilege}
<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">精彩瞬间</li>
    </ul>
        
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h3>精彩瞬间</h3>
            </div>
            <div class="alert alert-error" id="page_across_border" style="display: none;">
                
            </div>
            {if not $isDisplay} 
                <div class="row">
                    <div class="span12">
                        <div class="alert alert-error">
                             {$errorInfo}
                        </div> 
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="span12">
                        <div class="alert alert-success">
                            所有图片均上传到百度相册：<a href="http://xiangce.baidu.com/448class">http://xiangce.baidu.com/448class</a>
                            <br /><br />
                            如果你有更多照片，欢迎继续上传！
                            <br /><br />
                            用户名：永远的448<br />
                            密码：wudiguanwang26
                            <br /><br />
                            为了大家都能够登录，请亲们就不要偷偷的改密码了额。。。
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>
{include file="footer.tpl" basicInfo=$basicInfo}    