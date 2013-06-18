{include file="header.tpl" basicInfo=$basicInfo userPrivilege=$userPrivilege}
<div class="container">
    <ul class="breadcrumb" id="index_breadcrumb">
        <li><a href="index.php">首页</a> <span class="divider">/</span></li>
        <li><a href="classmates.php">同学录</a> <span class="divider">/</span></li>
        {if $isDisplay}
            <li class="active">{$data.name}</li>
        {else}
            <li class="active">无法提供信息</li>
        {/if}
    </ul>
    
    <div id="account_detail_background">
        {if $isDisplay}
            <div id="account_detail_info">
                <div class="row">
                    <div class="span2 offset1">
                        <br /><br /><br /><br /><br />           
                        <img src="{$data.avatar}" class="img-rounded">
                    </div>
                    <div class="span8">
                        <div class="page-header">
                            <h3>基本信息</h3>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>姓名</dt>
                            <dt>性别</dt>
                            <dt>生日</dt>
                            <dt>血型</dt>
                            <dt>居住地址</dt>
                            <dd>{$data.name}</dd>
                            <dd>{$data.sex}</dd>
                            <dd>{$data.birthday}</dd>
                            <dd>{$data.blood_type}</dd>
                            <dd>{$data.residence}</dd>
                        </dl>
                        <hr />
                        <dl class="dl-horizontal">
                            <dt>给大家的话</dt>
                            <dd>{$data.give_others}</dd>
                        </dl>
                        <div class="page-header">
                            <h3>详细信息</h3>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>民族</dt>
                            <dd>{$data.nation}</dd>  
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>体重</dt>
                            <dd>{$data.weight} kg</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>身高</dt>
                            <dd>{$data.height} cm</dd>                           
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>学校及专业</dt>
                            <dd>{$data.speciality}</dd>  
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Email</dt>
                            <dd>{$data.email}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>QQ</dt>
                            <dd>{$data.qq}</dd>      
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>手机1</dt>             
                            <dd>{$data.phone_1}</dd> 
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>手机2</dt>
                            <dd>{$data.phone_2}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>手机3</dt> 
                            <dd>{$data.phone_3}</dd>                            
                        </dl>
                        <div class="page-header">
                            <h3>兴趣爱好</h3>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>喜欢的书籍</dt>
                            <dd>{$data.hobby_books}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>喜欢的音乐</dt>
                            <dd>{$data.hobby_music}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>喜欢的电影</dt>
                            <dd>{$data.hobby_movie}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>喜欢的品牌</dt>
                            <dd>{$data.hobby_brands}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>喜欢的运动</dt>
                            <dd>{$data.hobby_sports}</dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>崇拜的人</dt>
                            <dd>{$data.hobby_worship}</dd>                        
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>其他爱好</dt>
                            <dd>{$data.hobby_others}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        {else}
            <div class="alert alert-error">
                {$errorInfo}
            </div>
        {/if}
    </div>
</div>
{include file="footer.tpl" basicInfo=$basicInfo}