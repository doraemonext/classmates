<section id="main" class="column">
    <article class="module width_full">
        <header><h3>座右铭设置</h3></header>
        <table class="tablesorter" cellspacing="0"> 
            <thead> 
                <tr> 
                    <th width="40px"></th> 
                    <th width="30px">ID</th>
                    <th>座右铭内容</th> 
                    <th width="80px">操作</th> 
                </tr> 
            </thead> 
            <tbody> 
                {foreach from=$mottoData key=id item=content}
                    <tr> 
                        <td><input type="checkbox"></td> 
                        <td>{$id}</td>
                        <td>{$content}</td> 
                        <td><input type="image" src="images/admin/icn_edit.png" title="Edit"><input type="image" src="images/admin/icn_trash.png" title="Trash"></td> 
                    </tr> 
                {/foreach}
            </tbody> 
        </table>
        <footer>
            <div class="button_link">
                <input type="button" value="删除所选">
                <input type="button" value="添加座右铭" class="alt_btn">                
            </div>
        </footer>
    </article>
</section>