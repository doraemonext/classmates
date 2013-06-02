$(function() {
    // 使得 $.getScript 获取脚本时可以进行缓存
    // 对于其他 ajax 内容，请求时自行添加 &sid=Math.random() 来防止缓存  
    $.ajaxSetup({
        cache: true
    });
    
    $.getScript("libs/bootstrap/js/bootstrap.min.js");
    $.getScript("libs/messenger/build/js/underscore-min.js");
    $.getScript("libs/messenger/build/js/backbone-min.js");
    $.getScript("libs/messenger/build/js/messenger.min.js");
    $.getScript("libs/jquery/jquery.json.js");
    $.getScript("templates/js/tools/scroll_content.js");
    $.getScript("templates/js/tools/validation.js", function() {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
    });    
    $.getScript("templates/js/tools/popup.js");
    $.getScript("templates/js/tools/get_html_value.js");
    $.getScript("templates/js/tools/encrypt.js");
    
    navigationMotto();
    displayAccountInfo();
    displayIndexWriting();
    displayIndexPicture();
});    

function jumpToErrorPage(content) {
    window.location.href = "error.php?content=" + content;
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

// 删除节点root的所有子节点
function clearChildNode(root) {
    var child = root.childNodes;
    for (var i = child.length - 1; i >= 0; i--) {
        root.removeChild(child[i]);
    }
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

// 显示“个人信息管理“页面的”基本资料“
function accountChangeToBasic() {
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
               if (info["sex"] == 0) {    // 男
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
           "json": escape(sendData)
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