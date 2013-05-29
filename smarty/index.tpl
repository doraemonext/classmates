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
                                    <img id="index_username_avatar" src="images/tourist.png" alt="">
                                </a>
                            </div>
                            <div class="span3">
                                <p><strong><span id="index_username"></span>，欢迎您的使用<br /><br /></strong></p>
                                <a class="btn btn-success" href="#"> 个人信息管理</a>
                                &nbsp;&nbsp;
                                <a class="btn btn-primary" href="#"> 安全退出</a>
                            </div>
                        </div>
                    {/if}
            </div>
        </div>
    </header>
    <br/>
    
    <div class="white_framework">
        <div class="row">
            <div class="span7">
                <ul class="diaporama1" id="index_picture_show">
                    <li><img src="images/galerie/image1.jpg" alt="On the road again" title="Sur la route de l'ouest, Arizona &copy; Guillaume Voisin" /></li>
                </ul>
                <br />
            </div>
            <div class="span4" id="index_writing">
                <h4>
                    <br />
                    <br />
                    <p>长缨高冠，全宇轩昂意气扬</p>
                    <br />
                    <p>铁刃钢枪，驰骋疆场何人挡</p>
                    <br />
                    <p>狼毫软笔，尤飞凤舞书华章</p>
                    <br />
                    <p>448班，宏志高歌定称王！</p>
                    <br />
                    <p align="right">——孙胜扬</p>
                </h4>
            </div>
            <br/>
        </div>
    </div>
    
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="#">首页</a> <span class="divider">/</span></li>
        <li><a href="#">同学录</a> <span class="divider">/</span></li>
        <li class="active">预览</li>
    </ul>
    
    <div class="row">
        <div class="span8">
            <div class="page-header">
                <h3>同学录一览</h3>
            </div>
            <div class="row" id="index_classmates">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
                <div class="span2">
                    <a href="#" class="thumbnail">
                        <img src="images/448/guoyaoxing.png" alt="">
                    </a>
                </div>
                <div class="span2">
                    <p>
                        姓名：郭耀星 <br />
                        性别：男 <br />
                        民族：汉族 <br />
                    </p>
                    <p><a class="btn btn-primary" href="#">详细信息</a></p>
                </div>
            </div>
                <div class="pagination" id="index_pagination">
                    <ul>
                        <li><a href="#">Prev</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">Next</a></li>
                    </ul>
                </div>
            </div>
            <div class="span4">
                <div class="page-header">
                    <h3>最新公告</h3>
                </div>
                <div class="well" id="index_announcement">
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    <br />
                    详细信息详细信息详细信息详细信息xxx
                    
                </div>
                <div class="page-header">
                    <h3>留言板</h3>
                </div>
                <div id="index_message">
                    <p>我说了一句猥琐的话</p>
                    <p align="right">——郭耀星</p>
                    <br />
                </div>
                <div class="controls">
                    <strong>你有什么想说的？</strong>
                    <br />
                    <br />
                    <textarea class="input-xlarge" id="textarea" rows="5" ></textarea>
                    <a class="btn btn-primary" href="#" >提交</a>
                </div>
            </div>
        </div>
        <hr />
    </div>
        
    <!-- 登录窗口 -->
    <div style="display: none;" id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel" class="well">登录</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action='login.php' method="POST">
                <fieldset>
                    <div class="control-group"></div>
                    <div class="control-group">
                        <label class="control-label" for="username">姓名</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="input-large">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="password">密码</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="input-large">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">提交</button>
        </div>
    </div>
        
    <!-- 注册窗口 -->
    <div style="display: none;" id="regModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h3 id="myModalLabel" class="well">注册</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action='register.php' method="POST">
                <fieldset>
                    <div class="control-group"></div>
                    <div class="control-group">
                        <label class="control-label" for="username">姓名</label>
                        <div class="controls">
                            <input type="text" id="username" name="username" placeholder="" class="input-large">
                            <p class="help-block">请填写<strong>真实姓名</strong>，经验证方可使用全部功能</p>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="password">密码</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="" class="input-large">
                            <p class="help-block">5 ~ 20位，不得有特殊字符</p>
                        </div>
                    </div>
                        
                    <div class="control-group">
                        <label class="control-label" for="password_confirm">密码确认</label>
                        <div class="controls">
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-large">
                            <p class="help-block">请再次确认您刚才输入的密码</p>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary">提交注册信息</button>
        </div>
    </div>    
<!-- div container 在footer.tpl关闭 -->    
    
    
