{include file="header.tpl" basicInfo=$basicInfo userPrivilege=$userPrivilege}
<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li class="active">同学录</li>
    </ul>
        
    <div class="row">
        <div class="span12">
            <div class="page-header">
                <h3>同学录一览<small>（按姓名首字拼音排序）</small></h3>
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
                {foreach from=$data key=nouse item=value}
                    <div class="row">
                        {foreach from=$value key=nouse_1 item=content}
                            <div class="span2">
                                <a href="account_detail.php?id={$content[0]}" class="thumbnail">
                                    <img src="{$content[2]}" alt="">
                                </a>
                            </div>
                            <div class="span2">
                                <br />
                                <h4><strong>&nbsp;&nbsp;&nbsp;{$content[1]}</strong></h4>
                                <p><a class="btn btn-primary" href="account_detail.php?id={$content[0]}">详细信息</a></p>
                            </div>
                        {/foreach}
                    </div>
                    <hr />
                {/foreach}
                <div class="pagination" id="index_pagination">
                    <ul>
                        {if $page neq 1}
                            <li><a href="classmates.php?page={"`$page-1`"}">上一页</a></li>
                        {/if} 
                        {section name=loop loop=$totalPageSum}
                            {if $smarty.section.loop.index+1 eq $page}
                                <li class="active"><a>{"`$smarty.section.loop.index+1`"}</a></li>
                            {else}
                                <li><a href="classmates.php?page={"`$smarty.section.loop.index+1`"}">{"`$smarty.section.loop.index+1`"}</a></li>
                            {/if}
                        {/section}
                        {if $page neq $totalPageSum}
                            <li><a href="classmates.php?page={"`$page+1`"}">下一页</a></li>
                        {/if} 
                    </ul>
                </div>
            {/if}
        </div>
    </div>
</div>
{include file="footer.tpl" basicInfo=$basicInfo}    