<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{$basicInfo.title}</title>
        <link rel="stylesheet" type="text/css" href="templates/css/style.css">
        <script type="text/javascript" src="libs/jquery/jquery.js"></script>    
        <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="libs/messenger/build/js/underscore-min.js"></script>
        <script type="text/javascript" src="libs/messenger/build/js/backbone-min.js"></script>
        <script type="text/javascript" src="libs/messenger/build/js/messenger.min.js"></script>
        <script type="text/javascript" src="libs/jquery/jquery.json.js"></script>        
        <script type="text/javascript" src="templates/js/tools/scroll_content.js"></script>
        <script type="text/javascript" src="templates/js/tools/validation.js"></script>
        <script type="text/javascript" src="templates/js/tools/popup.js"></script>
        <script type="text/javascript" src="templates/js/tools/encrypt.js"></script>
        <script type="text/javascript" src="templates/js/classmates.js"></script>
    
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="./index.php">{$basicInfo.title}</a>
                    <div class="nav-collapse collapse" id="main-menu">
                        <ul class="nav pull-left" id="main-menu-left">
                            {foreach from=$basicInfo.navigationPage key=name item=address}
                                {if $pageLocated == $address}
                                    <li class="active"><a href="{$address}.php"><strong>{$name}</strong></a></li>
                                {else}
                                    <li><a href="{$address}.php"><strong>{$name}</strong></a></li>
                                {/if}
                            {/foreach}
                            <li><a href="admin.php"><strong>管理后台</strong></a></li>
                        </ul>
                        <div class="nav pull-right" id="main-menu-right">
                            <div class="scrollDiv" id="navigation_motto">
                                <!-- Javascript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
            
        <div class="container">
            <header class="jumbotron subhead" id="overview">
                <div class="row">
                    <div class="span7">
                        <h1><a style="text-decoration: none" href="index.php">{$basicInfo.title}</a></h1>
                        <p class="lead">{$basicInfo.subtitle}</p>
                    </div>
                    <div class="span4" id="account_info">
                        <br />
                        {if $userPrivilege == 0}
                            <div class="row" id="account_info_unknown">
                                <div class="span1">
                                    <a href="#" class="thumbnail">
                                        <img src="images/tourist.png" />
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong>游客您好，您现在还没有登录<br /><br /></strong></p>
                                    <a href="#" class="btn btn-success" onclick="$('#loginModal').modal('show')"> 登录</a>
                                    &nbsp;&nbsp;
                                    <a href="#" class="btn btn-primary" onclick="$('#regModal').modal('show')"> 注册</a>
                                </div>
                            </div>
                        {else}
                            <div class="row" id="account_info_known">
                                <div class="span1">
                                    <a href="account.php" class="thumbnail">
                                        <img id="header_username_avatar" src="" alt="">
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong><span id="header_username"></span>，欢迎回来<br /><br /></strong></p>
                                    {if $pageLocated == 'account'}
                                        <a class="btn btn-success" href="index.php"> 返回主页</a>
                                    {else}
                                        <a class="btn btn-success" href="account.php"> 个人信息管理</a>
                                    {/if}
                                    
                                    <a class="btn btn-primary" onclick="logout()"> 安全退出</a>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </header>
            <br/>
        </div>