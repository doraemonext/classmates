<section id="main" class="column">
    <article class="module width_full">
        <header><h3>座右铭设置</h3></header>
        <table class="tablesorter" cellspacing="0"> 
            <thead> 
                <tr> 
                    <th width="40px"></th> 
                    <th>座右铭内容</th> 
                    <th width="80px">操作</th> 
                </tr> 
            </thead> 
            <tbody> 
                {foreach from=$mottoData key=id item=content}
                    <tr id="mottoTR{$id}"> 
                        <td><input name="mottoCheckbox" value="{$id}" type="checkbox"></td> 
                        <td><label id="mottoId{$id}">{$content}</label></td> 
                        <td>
                            <a href="#" id="mottoEditId{$id}" onclick="mottoMakeEdit({$id})">
                                <img src="images/admin/icn_edit.png">
                            </a>
                            &nbsp;&nbsp;
                            <a href="#" id="mottoDeleteId{$id}" onclick="mottoDelete([{$id}])">
                                <img src="images/admin/icn_trash.png">
                            </a>
                        </td> 
                    </tr> 
                {/foreach}
            </tbody> 
        </table>
        <footer>
            <div class="button_link">
                <input type="button" value="删除所选" onclick="mottoDeleteCheckbox()">
                <input type="button" value="添加座右铭" onclick="mottoNewDisplay()" class="alt_btn">        
            </div>
        </footer>
    </article>
</section>

<script>
     $(function() {
         $("#add_motto").hide();
     });
</script>            
<div id="add_motto" title="添加座右铭">
    <form>
        <label for="mottoNew">请输入新的座右铭：</label>
        <input type="text" name="mottoNew" id="mottoNew" maxlength="32" style="width:450px" /> 
        <br /><br />
        字数限制：32字以内
    </form>
</div>