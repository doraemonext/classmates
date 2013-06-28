$(function() {
    navigationMotto();
    displayAccountInfo();
    displayIndexWriting();
    displayIndexPicture();
});    

function jumpToErrorPage(content) {
    window.location.href = "error.php?content=" + content;
}
function makeValidation() {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
}

// 在页面加载后显示导航条上的座右铭
function navigationMotto()
{
    $.getJSON("response/navigation_motto.php?sid=" + Math.random(), function(info) {
        $("#navigation_motto").append($("<ul></ul>"));
        for (var i = 0; i < info.length; i++) {
            $("#navigation_motto ul:last-child").append("<li>" + info[i] + "</li>");
        }
    });
}

// 当用户登录的情况下，更新用户名及头像
function displayAccountInfo() {
    // 当用户未登录情况下，直接返回，显示默认内容
    if ($("#account_info").children().is("#account_info_unknown")) {
        return;
    }
    $.getJSON("response/display_account.php?sid=" + Math.random(), function(info) {
        var username, avatar;
        if (info["status"] == "ERROR") {
            jumpToErrorPage(info["statusInfo"]);
            return;
        }
        username = info["username"];
        avatar = info["avatar"];
        $("#header_username").empty();
        $("#header_username").html(username);
        $("#header_username_avatar").attr("src", avatar + "?sid=" + Math.random());
    });
}

// 在登录时显示登录进度
function displayLoginInfo() {
    var salt;
    var username = $("#login_username").val();
    var password = $("#login_password").val();
    $.get("response/get_salt.php", function(info) { salt = info; });
    var finalPassword = md5(md5(password) + salt);
    $.ajax({
       type: "POST",
       url: "login.php",
       data: {
           "username": escape(username),
           "password": escape(finalPassword),
           "salt": escape(salt)
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError(10);
       },
       beforeSend: function() {
           $("#login_info").css("display", "block");
           $("#login_info").attr("class", "alert alert-info");
           $("#login_info").empty();
           $("#login_info").html("正在登录中，请稍后……");
       },
       success: function(info, textStatus) {
           if (info["status"] == "OK") {
               $("#login_info").css("display", "block");
               $("#login_info").attr("class", "alert alert-success");
               $("#login_info").empty();
               $("#login_info").html("登录成功，正在跳转……");
               location.reload();
           } else {
               $("#login_info").css("display", "block");
               $("#login_info").attr("class", "alert alert-error");
               $("#login_info").empty();
               $("#login_info").html(info["statusInfo"]);
           }
       }
    });
}

// 注册用户
function register() {
    var username = $("#reg_username").val();
    var password = $("#reg_password").val();
    var confirmPassword = $("#reg_password_confirm").val();
    
    $.ajax({
       type: "POST",
       url: "register.php",
       data: {
           "username": escape(username),
           "password": escape(md5(password)),
           "password_confirm": escape(md5(confirmPassword))
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError(10);
       },
       beforeSend: function() {
           $("#register_info").css("display", "block");
           $("#register_info").attr("class", "alert alert-info");
           $("#register_info").empty();
           $("#register_info").html("正在注册中，请稍后……");
       },
       success: function(info, textStatus) {
           if (info["status"] == "OK") {
               $("#register_info").css("display", "block");
               $("#register_info").attr("class", "alert alert-success");
               $("#register_info").empty();
               $("#register_info").html("注册成功，正在跳转……");
               location.reload();
           } else {
               $("#register_info").css("display", "block");
               $("#register_info").attr("class", "alert alert-error");
               $("#register_info").empty();
               $("#register_info").html(info["statusInfo"]);
           }
       }
    });
}

// 使得用户安全退出，销毁session
function logout() {
    $.ajax({
        type: "GET",
        url: "response/logout.php",
        error: function() {
            showAjaxError();
        },
        success: function() {
            location.href = "index.php";
        }
    });
}

// 显示首页图片轮播右侧的文字
function displayIndexWriting() {
    // 当并非首页的时候，不显示文字
    if ($("#index_writing").length == 0) {
        return;
    }
    
    $.ajax({
        type: "GET",
        url: "response/get_index_writing.php",
        error: function() {
            showAjaxError();
        },
        beforeSend: function() {
            $("#index_writing").html("正在加载中，请稍后……");
        },
        success: function(info) {
            $("#index_writing").html(info);
        }
    });
}

// 显示首页轮播图片
function displayIndexPicture() {
    if ($("#index_picture_navigation").length == 0) {
        return;
    }
    
    $.ajax({
        type: "GET",
        url: "response/get_index_picture.php",
        dataType: "json",
        error: function() {
            showAjaxError();
        },
        success: function(info) {
            var total = info["total"];
            $("#index_picture_navigation").empty();
            for (var i = 0; i < total; i++) {
                if (i == 0) {
                    $("#index_picture_navigation").append("<li class=\"active\" data-target=\"#pic_carousel\" data-slide-to=\"" + i + "\"></li>");
                } else {
                    $("#index_picture_navigation").append("<li data-target=\"#pic_carousel\" data-slide-to=\"" + i + "\"></li>");
                }
            }
            
            $("#index_picture_url").empty();
            for (var i = 0; i < total; i++) {
                if (i == 0) {
                    $("#index_picture_url").append("<div class=\"active item\"><img src=\"" + info["img"][i] + "\" /></div>");
                } else {
                    $("#index_picture_url").append("<div class=\"item\"><img src=\"" + info["img"][i] + "\" /></div>");
                }
            }
        }
    });    
}

// 为了满足日期选择插件的要求
function runAccountBasicJS() {
    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd',
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 4,
        forceParse: 1,
        minView: 2
    });
}

function showAccountPageOnly(id) {
    var idArray = new Array( 
        "account_content_basic",
        "account_content_detail",
        "account_content_hobby",
        "account_password"
    );
        
    for (var i = 0; i < idArray.length; i++) {
        if (idArray[i] == id) {
            $.ajax({
               type: "GET",
               url: "smarty/account/" + idArray[i] + ".html",
               dataType: "html",
               async: false,
               cache: false,
               success: function(info) {
                   $("#" + idArray[i]).html(info);
                   makeValidation();
               }
            });
        } else {
            $("#" + idArray[i]).empty();
        }
    }
    $("#account_content_avatar").empty();
    $("#account_content_avatar_upload").empty();
    
    if (id == "account_content_avatar") {
        $.ajax({
           type: "GET",
           url: "smarty/account/account_content_avatar.html",
           dataType: "html",
           async: false,
           cache: false,
           success: function(info) {
               $("#account_content_avatar").html(info);
           }
       });
    }
}

// 显示“个人信息管理“页面的”基本资料“
function accountChangeToBasic() {
    showAccountPageOnly("account_content_basic");
    $.ajax({
       type: "GET",
       url: "response/get_account_basic.php",
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               $("#account_name").attr("value", info["name"]);
               if (info["sex"] == null || info["sex"] == 0) {    // 男
                   $("input[type=radio][name=account_sex][value=man]").attr("checked", true); 
               } else {                   // 女
                   $("input[type=radio][name=account_sex][value=woman]").attr("checked", true); 
               }
               $("#account_birthday").attr("value", info["birthday"]);
               $("#account_blood_type").get(0).selectedIndex = info["bloodType"];
               $("#account_residence").attr("value", info["residence"]);
               $("#account_give_others").val(info["giveOthers"]);
           }
       }
    });
}

// 提交“个人信息管理“页面的”基本资料“信息
function submitAccountBasic() {
    var sendData = $.toJSON($("#account_basic_form").serializeArray());
    $.ajax({
       type: "POST",
       url: "response/submit_account_basic.php",
       data: {
           "json": sendData
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
               showPopupMessage("bottom-center", "success", "您的信息已成功修改");
           }
       }
    });
}

// 显示“个人信息管理“页面的”详细资料“
function accountChangeToDetail() {
    showAccountPageOnly("account_content_detail");
    $.ajax({
       type: "GET",
       url: "response/get_account_detail.php",
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               $("#account_nation").attr("value", info["nation"]);
               $("#account_weight").attr("value", info["weight"]);               
               $("#account_height").attr("value", info["height"]);               
               $("#account_speciality").attr("value", info["speciality"]);               
               $("#account_email").attr("value", info["email"]);
               $("#account_qq").attr("value", info["qq"]);      
               $("#account_phone_1").attr("value", info["phone_1"]);
               $("#account_phone_2").attr("value", info["phone_2"]);
               $("#account_phone_3").attr("value", info["phone_3"]);               
           }
       }
    });
}

// 提交“个人信息管理“页面的”详细资料“信息
function submitAccountDetail() {
    var sendData = $.toJSON($("#account_detail_form").serializeArray());
    $.ajax({
       type: "POST",
       url: "response/submit_account_detail.php",
       data: {
           "json": sendData
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
               showPopupMessage("bottom-center", "success", "您的信息已成功修改");
           }
       }
    });
}

// 显示“个人信息管理”页面的“兴趣爱好”信息
function accountChangeToHobby() {
    showAccountPageOnly("account_content_hobby");
    $.ajax({
       type: "GET",
       url: "response/get_account_hobby.php",
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError();
       },
       success: function(info, textStatus) {
           if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           } else {
               $("#account_books").val(info["books"]);
               $("#account_music").val(info["music"]);               
               $("#account_movie").val(info["movie"]);               
               $("#account_brands").val(info["brands"]); 
               $("#account_sports").val(info["sports"]);
               $("#account_worship").val(info["worship"]);
               $("#account_others").val(info["others"]);      
           }
       }
    });   
}

// 提交“个人信息管理”页面的“兴趣爱好”信息
function submitAccountHobby() {
    var sendData = $.toJSON($("#account_hobby_form").serializeArray());
    $.ajax({
       type: "POST",
       url: "response/submit_account_hobby.php",
       data: {
           "json": sendData
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
               showPopupMessage("bottom-center", "success", "您的信息已成功修改");
           }
       }
    });
}

// 显示“个人信息管理”页面的“个人头像”信息
function accountChangeToAvatar(userId) {
    showAccountPageOnly("account_content_avatar");
    $.ajax({
        type: "GET",
        url: "response/get_submit_account_avatar.php",
        dataType: "json",
        error: function() {
            showAjaxError();
        },
        success: function(info) {
            if (info["status"] == "ERROR") {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
            } else {
                if (info['exist']) {
                    $("#account_avatar_no_avatar").css("display", "none");
                    $("#account_avatar_have_avatar").css("display", "block");
                    $("#avatar_120").attr("src", info['path']);
                } else {
                    $("#account_avatar_no_avatar").css("display", "block");
                    $("#account_avatar_have_avatar").css("display", "none");
                }
            }
        }
    });
    $("#account_content_avatar_upload").load("libs/avatar/upload.php?uid=" + userId);
}

function accountChangeToPassword() {
    showAccountPageOnly("account_password");
    makeValidation();
}

// 提交“个人信息管理”页面的“密码修改”信息
function submitAccountPassword() {
    var originPassword = $("#account_origin_password").val();
    var newPassword = $("#account_new_password").val();
    var confirmPassword = $("#account_confirm_password").val();
    
    $.ajax({
       type: "POST",
       url: "response/submit_account_password.php",
       data: {
           "originPassword": escape(md5(originPassword)),
           "newPassword": escape(md5(newPassword)),
           "confirmPassword": escape(md5(confirmPassword))
       },
       cache: false,
       dataType: "json",
       error: function() {
           showAjaxError(10);
       },
       success: function(info) {
           if (info["status"] == "OK") {
               showPopupMessage("bottom-center", "success", "您的密码已经成功修改。");
           } else {
               showPopupMessage("bottom-center", "error", info["statusInfo"]);
           }
       }
    });
}