<section id="main" class="column">
    <article class="module width_full">
        <header><h3>用户管理</h3></header>
        <table class="tablesorter" cellspacing="0"> 
            <thead> 
                <tr> 
                    <th>姓名</th> 
                    <th>当前权限</th>
                    <th width="120px">操作</th> 
                </tr> 
            </thead> 
            <tbody> 
                {foreach from=$userData key=id item=content}
                    <tr id="userTR{$id}"> 
                        <td><label id="userNameId{$id}">{$content[1]}</label></td> 
                        {if $content[2] == 1}
                            <td><label id="userPrivilegeId{$id}">禁止访问</label></td> 
                        {elseif $content[2] == 2}
                            <td><label id="userPrivilegeId{$id}">等待验证</label></td> 
                        {elseif $content[2] == 4}
                            <td><label id="userPrivilegeId{$id}">普通用户</label></td> 
                        {elseif $content[2] == 8}
                            <td><label id="userPrivilegeId{$id}">管理用户</label></td> 
                        {/if}

                        {if $content[2] != 8} 
                            <td>
                                <input type="button" value="修改权限" onclick="userEditPrivilege({$id}, {$content[2]})" class="alt_btn">
                            </td> 
                        {else}
                            <td>
                                无法操作管理用户
                            </td>
                        {/if}
                    </tr> 
                {/foreach}
            </tbody> 
        </table>
    </article>
</section>

<script>
     $(function() {
         $("#user_modify_privilege").hide();
     });
</script>            
<div id="user_modify_privilege" title="修改权限">
    <br />
    <form>
        <label>请选择新权限：</label>
        <select id="userPrivilege">
            <option value="1">禁止访问</option>
            <option value="2">等待验证</option>
            <option value="4">普通用户</option>
        </select>
    </form>
    <br />
</div>