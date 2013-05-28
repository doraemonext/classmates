<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>发生严重错误</title>
        <link rel="stylesheet" type="text/css" href="templates/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="templates/css/style.css">
        <script type="text/javascript" src="templates/js/jquery-1.3.2.min.js"></script>
    </head>
    
    <body>
        <hr />
        <div class="container">
            <div class="hero-unit well">
                <h2>非常抱歉，发生严重错误</h2>
                <p>该错误已被记录，我们将会尽快进行修复，谢谢。</p>
                <p>
                    错误信息：
                </p>
                <div class="alert alert-error" id="showException">
                    {if $error_type == 'plain'}
                        {$content}
                    {else}
                        Exception {$code}: {$msg} <br />
                        in {$file} on line {$line}.
                    {/if}
                </div>
                <a class="btn btn-primary btn-large" href="./index.php">
                    返回主页
                </a>
            </div>
        </div>
        <hr />
    </body>
</html>