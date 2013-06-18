<script type="text/javascript" src="libs/ajaxupload/ajaxfileupload.js"></script>
<section id="main" class="column">
    <article class="module width_full">
        <header><h3>图片轮播</h3></header>
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
    <article class="module width_full" id="pictureNewForm" style="display: none">
        <header><h3>添加图片</h3></header>
        <div class="module_content">
            <form action="response/admin/picture_new.php" method="post" enctype="multipart/form-data">
                <label for="pictureNew">请选择图片：</label>
                <input type="file" name="pictureNew" id="pictureNew" /> （最大文件大小：4M， 允许的文件类型：jpg, jpeg, png, gif）
                <br /><br />
                说明：所有上传图片的文件名都会被系统重新编码，并非上传失败。
            </form>
        </div>
        <footer>
            <div class="button_link">
                <input type="button" value="上传" onclick="pictureNewUpload()" class="alt_btn" />
                <input type="button" value="取消" onclick="pictureNewUndisplay()" />      
            </div>
        </footer>
    </article>
</section>