function submitSetting() {
    var title = $("#siteTitle").val();
    var subtitle = $("#siteSubtitle").val();
    var indexWriting = $("#siteIndexWriting").val();
    
    $.ajax({
       type: "POST",
       url: "response/admin/submit_setting.php",
       data: {
           "title": escape(title),
           "subtitle": escape(subtitle),
           "indexWriting": escape(indexWriting)
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               window.location.href = "admin.php?action=setting&status=success";
           }
       }
    });
}

function pictureMakeEdit(id) {
    var valueId = "#pictureId" + id;
    var editId = "#pictureEditId" + id;
    var url = $(valueId).html();
    $(valueId).html("<input type='text' style='width: 360px' id=\"pictureInputId" + id + "\" value='" + url + "'>");
    $(valueId).after(" <input type='button' id='pictureCancelId" + id + "' value='取消' onclick='pictureCancel(" + id + ", \"" + url + "\")'>");
    $(valueId).after(" <input type='button' id='pictureConfirmId" + id + "' class='alt_btn' value='确认' onclick='pictureConfirm(" + id + ")'>");
    $(editId).empty();
}
function pictureCancel(id, url) {
    $("#pictureId"+id).html(url);
    $("#pictureCancelId"+id).remove();
    $("#pictureConfirmId"+id).remove();
    $("#pictureEditId"+id).html("<img src=\"images/admin/icn_edit.png\">");
}
function pictureConfirm(id) {
    var url = $("#pictureInputId"+id).val();
    $.ajax({
       type: "POST",
       url: "response/admin/modify_picture.php",
       data: {
           "id": escape(id),
           "url": escape(url)
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               showPopupMessage("bottom-center", "success", "图片路径已成功修改。");
               $("#pictureId"+id).html(url);
               $("#pictureCancelId"+id).remove();
               $("#pictureConfirmId"+id).remove();
               $("#pictureEditId"+id).html("<img src=\"images/admin/icn_edit.png\">");
           }
       }
    });
}
function pictureNewDisplay() {
    $("#pictureNewForm").css("display", "block");
}
function pictureNewUndisplay() {
    $("#pictureNewForm").css("display", "none");
}
function pictureNewUpload() {
    $.ajaxFileUpload({
        url: 'response/admin/picture_new.php',
        secureuri: false,
        fileElementId: 'pictureNew',
        dataType: 'json',
        error: function() {
            showAjaxError();
        },
        success: function (info, status) {
            if (info["status"] == "ERROR"){
                showPopupMessage("bottom-center", "error", info["statusInfo"]);
            } else {
                window.location.reload();
            }
        }
    });
}
function pictureDeleteCheckbox() {
    var idArray = new Array();
    
    $("input[name='pictureCheckbox']:checked").each(function() {
        idArray.push($(this).val());
    });
    
    pictureDelete(idArray);
}
function pictureDelete(id) {
    var sendData = $.toJSON(id);
    
    $.ajax({
       type: "POST",
       url: "response/admin/delete_picture.php",
       data: {
           id: escape(sendData)
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               if (id.length == 1) {
                   showPopupMessage("bottom-center", "success", "图片已成功删除。");
                   $("#pictureTR"+id[0]).empty();
               } else {
                   window.location.reload();
               }
           }
       }
    });
}