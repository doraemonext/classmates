<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{$title}</title>
        <link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="templates/css/style.css">
        <link rel="stylesheet" type="text/css" href="templates/css/pic/style.css">        
        <script type="text/javascript" src="templates/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="templates/js/jquery.jDiaporama.js"></script>
        <script type="text/javascript" src="templates/js/script.js"></script>
        <script type="text/javascript" src="templates/js/classmates.js"></script>
        <script type="text/javascript" src="templates/js/tools/scroll_content.js"></script>
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