<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>{$basicInfo.title} 管理后台</title>
        <link rel="stylesheet" href="templates/css/admin/layout.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="libs/jquery-ui/css/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="templates/css/admin/ie.css" type="text/css" media="screen" />
        <script src="templates/css/admin/html5.js"></script>
        <![endif]-->
        <script src="libs/jquery-ui/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="libs/jquery-ui/jquery-ui-1.8.18.custom.min.js" type="text/javascript"></script>
        <script src="templates/js/admin/hideshow.js" type="text/javascript"></script>
        <script src="libs/jquery/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="libs/jquery/jquery.equalHeight.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() { 
                $(".tablesorter").tablesorter(); 
            });
            $(document).ready(function() {
                //When page loads...
                $(".tab_content").hide(); //Hide all content
                $("ul.tabs li:first").addClass("active").show(); //Activate first tab
                $(".tab_content:first").show(); //Show first tab content
                //On Click Event
                $("ul.tabs li").click(function() {
                    $("ul.tabs li").removeClass("active"); //Remove any "active" class
                    $(this).addClass("active"); //Add "active" class to selected tab
                    $(".tab_content").hide(); //Hide all tab content
                    var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
                    $(activeTab).fadeIn(); //Fade in the active ID content
                    return false;
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('.column').equalHeight();
            });
        </script>
        <script type="text/javascript" src="libs/messenger/build/js/underscore-min.js"></script>
        <script type="text/javascript" src="libs/messenger/build/js/backbone-min.js"></script>
        <script type="text/javascript" src="libs/messenger/build/js/messenger.min.js"></script>
        <script type="text/javascript" src="libs/jquery/jquery.json.js"></script>        
        <script type="text/javascript" src="templates/js/tools/popup.js"></script>
        <script type="text/javascript" src="templates/js/tools/encrypt.js"></script>
        <script type="text/javascript" src="templates/js/classmates.js"></script>
        <script type="text/javascript" src="templates/js/admin/admin.js"></script>
    </head>
    
    <body>
        <header id="header">
            <hgroup>
                <h1 class="site_title"><a href="admin.php">{$basicInfo.title}</a></h1>
                <h2 class="section_title">{$actionName}</h2><div class="btn_view_site"><a href="index.php">返回前台首页</a></div>
            </hgroup>
        </header> <!-- end of header bar -->
        
        <section id="secondary_bar">
            <div class="user">
                <p>管理员：{$username}</p>
            </div>
            <div class="breadcrumbs_container">
                <article class="breadcrumbs"><a href="index.html">管理后台</a> <div class="breadcrumb_divider"></div> <a class="current">{$actionName}</a></article>
            </div>
        </section><!-- end of secondary bar -->
        
        <aside id="sidebar" class="column">
            <h3>站点管理</h3>
            <ul class="toggle">
                <li class="icn_tags"><a href="admin.php?action=index">仪表盘</a></li>
                <li class="icn_settings"><a href="admin.php?action=setting">全局设置</a></li>
                <li class="icn_video"><a href="admin.php?action=picture">图片轮播</a></li>
                <li class="icn_folder"><a href="admin.php?action=motto">座右铭设置</a></li>                
            </ul>
            <h3>用户管理</h3>
            <ul class="toggle">
                {if $unverify > 0}
                    <li class="icn_security"><a href="admin.php?action=user_admin">用户管理</a> <strong><font color="red">({$unverify}人待验证)</font></strong></li>
                {else}
                    <li class="icn_security"><a href="admin.php?action=user_admin">用户管理</a></li>
                {/if}
            </ul>
        </aside><!-- end of sidebar -->

        {if $action == "index"}
            {include file="admin/admin_index.tpl" indexCountTotal=$indexCountTotal indexCountBanned=$indexCountBanned 
                                                   indexCountUnverify=$indexCountUnverify indexCountNormal=$indexCountNormal 
                                                   indexCountAdmin=$indexCountAdmin}
        {elseif $action == "setting"}
            {include file="admin/admin_setting.tpl" settingTitle=$settingTitle settingSubtitle=$settingSubtitle 
                                                     settingIndexWriting=$settingIndexWriting status=$status}
        {elseif $action == "picture"}
            {include file="admin/admin_picture.tpl" pictureData=$pictureData}
        {elseif $action == "motto"}
            {include file="admin/admin_motto.tpl" mottoData=$mottoData}
        {elseif $action == "user_admin"}
            {include file="admin/admin_user_admin.tpl" userData=$userData}
        {/if}
    </body>
</html>