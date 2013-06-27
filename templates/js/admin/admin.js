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
   $("#upload_picture").dialog({
       buttons: {
           "上传": function() {
               pictureNewUpload();
           },
           "取消": function() {
               $(this).dialog("close");
           }
       },
       width: 390,
       height: 190
   });
}
function pictureNewUpload() {
    var pictureObj = $("#pictureNew")[0].files[0];
    var form = new FormData();

    form.append("pictureNew", pictureObj);
    $.ajax({
        type: "POST",
        url: "response/admin/picture_new.php",
        data: form,
        contentType: false,
        processData: false,
        cache: false,
        error: function() {
            showAjaxError();
        },
        success: function(info, textStatus) {
            if (info["status"] == "ERROR") {
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

function mottoMakeEdit(id) {
    var valueId = "#mottoId" + id;
    var editId = "#mottoEditId" + id;
    var content = $(valueId).html();
    $(valueId).html("<input type='text' style='width: 360px' id=\"mottoInputId" + id + "\" value='" + content + "'>");
    $(valueId).after(" <input type='button' id='mottoCancelId" + id + "' value='取消' onclick='mottoCancel(" + id + ", \"" + content + "\")'>");
    $(valueId).after(" <input type='button' id='mottoConfirmId" + id + "' class='alt_btn' value='确认' onclick='mottoConfirm(" + id + ")'>");
    $(editId).empty();
}
function mottoCancel(id, content) {
    $("#mottoId"+id).html(content);
    $("#mottoCancelId"+id).remove();
    $("#mottoConfirmId"+id).remove();
    $("#mottoEditId"+id).html("<img src=\"images/admin/icn_edit.png\">");
}
function mottoConfirm(id) {
    var content = $("#mottoInputId"+id).val();
    $.ajax({
       type: "POST",
       url: "response/admin/modify_motto.php",
       data: {
           "id": escape(id),
           "content": escape(content)
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
               showPopupMessage("bottom-center", "success", "座右铭成功修改。");
               $("#mottoId"+id).html(content);
               $("#mottoCancelId"+id).remove();
               $("#mottoConfirmId"+id).remove();
               $("#mottoEditId"+id).html("<img src=\"images/admin/icn_edit.png\">");
           }
       }
    });
}
function mottoNewDisplay() {
   $("#add_motto").dialog({
       buttons: {
           "确定": function() {
               mottoNewAdd();
           },
           "取消": function() {
               $(this).dialog("close");
           }
       },
       width: 600,
       height: 140
   });
}
function mottoNewAdd() {
    var mottoContent = $("#mottoNew").val();

    $.ajax({
        type: "POST",
        url: "response/admin/motto_new.php",
        data: {
            mottoContent: mottoContent
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
                window.location.reload();
            }
        }
    });
}
function mottoDeleteCheckbox() {
    var idArray = new Array();
    
    $("input[name='mottoCheckbox']:checked").each(function() {
        idArray.push($(this).val());
    });
    
    mottoDelete(idArray);
}
function mottoDelete(id) {
    var sendData = $.toJSON(id);
    
    $.ajax({
       type: "POST",
       url: "response/admin/delete_motto.php",
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
                   showPopupMessage("bottom-center", "success", "座右铭已成功删除。");
                   $("#mottoTR"+id[0]).empty();
               } else {
                   window.location.reload();
               }
           }
       }
    });
}

function userEditPrivilege(id, privilege) {
    $("#userPrivilege").val(privilege);

    $("#user_modify_privilege").dialog({
       buttons: {
           "确定": function() {
               userAccept(id, $("#userPrivilege").val());
           },
           "取消": function() {
               $(this).dialog("close");
           }
       },
       width: 210,
       height: 130
   });
}
function userAccept(id, privilege) {
    $.ajax({
        type: "POST",
        url: "response/admin/user_accept.php",
        data: {
            id: escape(id),
            privilege: escape(privilege)
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
                window.location.reload();
            }
        }
    })
}