<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="templates/css/style.css">
        <link rel="stylesheet" type="text/css" href="templates/css/pic/style.css">               
        <script type="text/javascript" src="templates/js/jquery.js"></script>        
        <script type="text/javascript" src="templates/js/bootstrap.min.js"></script>     
        <script type="text/javascript" src="templates/js/picture/jquery.jDiaporama.js"></script>
        <script type="text/javascript" src="templates/js/picture/script.js"></script>
        <script type="text/javascript" src="templates/js/tools/scroll_content.js"></script>  
        <script type="text/javascript" src="templates/js/tools/validation.js"></script>  
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
                    <a class="brand" href="./index.php">{$title}</a>
                    <div class="nav-collapse collapse" id="main-menu">
                        <ul class="nav pull-left" id="main-menu-left">
                            {foreach from=$navigationPage key=name item=address}
                                <li><a href="{$address}"><strong>{$name}</strong></a></li>
                            {/foreach}
                        </ul>
                        <div class="nav pull-right" id="main-menu-right">
                            <div class="scrollDiv" id="navigationMotto">
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
                        <h1>{$title}</h1>
                        <p class="lead">{$subtitle}</p>
                    </div>
                    <div class="span4">
                        <br />
                        {if $uid == 'unknown'}
                            <div class="row">
                                <div class="span1">
                                    <a href="{$images_tourist}" class="thumbnail">
                                        <img src="images/tourist.png" />
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong>游客您好，您现在还没有登录<br /><br /></strong></p>
                                    <a data-toggle="modal" href="#loginModal" class="btn btn-success"> 登录</a>
                                    &nbsp;&nbsp;
                                    <a data-toggle="modal" href="#regModal" class="btn btn-primary"> 注册</a>
                                </div>
                            </div>
                        {else}
                            <div class="row">
                                <div class="span1">
                                    <a href="#" class="thumbnail">
                                        <img id="headerUsernameAvatar" src="images/tourist.png" alt="">
                                    </a>
                                </div>
                                <div class="span3">
                                    <p><strong><span id="headerUsername"></span>，欢迎您的使用<br /><br /></strong></p>
                                    <a class="btn btn-success" href="#"> 个人信息管理</a>
                                    &nbsp;&nbsp;
                                    <a class="btn btn-primary" onclick="logout()"> 安全退出</a>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </header>
            <br/>