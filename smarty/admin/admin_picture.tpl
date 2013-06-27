<section id="main" class="column">
    <article class="module width_full">
        <header><h3>图片轮播</h3></header>
        <div class="row">
            
        </div>
        <table class="tablesorter" cellspacing="0"> 
            <thead> 
                <tr> 
                    <th width="40px"></th> 
                    <th>图片路径</th> 
                    <th width="80px">操作</th> 
                </tr> 
            </thead> 
            <tbody> 
                {foreach from=$pictureData key=id item=url}
                    <tr id="pictureTR{$id}"> 
                        <td><input name="pictureCheckbox" value="{$id}" type="checkbox"></td> 
                        <td><label id="pictureId{$id}">{$url}</label></td>
                        <td>
                            <a href="#" id="pictureEditId{$id}" onclick="pictureMakeEdit({$id})">
                                <img src="images/admin/icn_edit.png">
                            </a>
                            &nbsp;&nbsp;
                            <a href="#" id="pictureDeleteId{$id}" onclick="pictureDelete([{$id}])">
                                <img src="images/admin/icn_trash.png">
                            </a>
                        </td> 
                    </tr> 
                {/foreach}
            </tbody> 
        </table>
        <footer>
            <div class="button_link">
                <input type="button" value="删除所选" onclick="pictureDeleteCheckbox()">
                <input type="button" value="添加图片" onclick="pictureNewDisplay()" class="alt_btn">                
            </div>
        </footer>
    </article>
</section>
    
<script>
     $(function() {
         $("#upload_picture").hide();
     });
</script>            
<div id="upload_picture" title="上传图片">
    <form action="#" method="post" enctype="multipart/form-data">
        <label for="pictureNew">请选择图片：</label>
        <input type="file" name="pictureNew" id="pictureNew" /> 
        <br /><br />
        最大文件大小：4M， 允许的文件类型：jpg, jpeg, png, gif
        <br /><br />
        说明：所有上传图片的文件名都会被系统重新编码，并非上传失败。
    </form>
</div>
