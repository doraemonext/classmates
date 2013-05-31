<?php

/**
 * 文件说明：返回“个人信息管理”页面的“基本信息的HTML代码
 *
 * @author     Doraemonext
 */

require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../functions.php';

require dirname(__FILE__).'/../safe.php';
require dirname(__FILE__).'/../tools/cookie.php';

$returnValue = array();

if (!isset($_SESSION['userCookie'])) {
    $returnValue['status'] = 'ERROR';
    $returnValue['statusInfo'] = '对不起，您的 Cookie 有误，请重新登录';
    echo json_encode($returnValue);
    exit();
}

try {
    $db = mysqlConnect($_config['db']['host'], $_config['db']['username'],
                       $_config['db']['password'], $_config['db']['dbname']);
    $query = 'SET NAMES UTF8';
    $db->query($query);
    $query = 'SELECT * FROM `classmates` WHERE `id` = '.intval($_SESSION['userId']);
    $result = $db->query($query);
    if ($result->num_rows != 1) {
        $returnValue['status'] = 'ERROR';
        $returnValue['statusInfo'] = '您好，数据库异常，请联系管理员';
        echo json_encode($returnValue);
        exit();
    }
    
    $rows = $result->fetch_object();
    
    $name = $rows->name;
    $sex = $rows->sex;
    $birthday = $rows->birthday;
    $residence = $rows->residence;
    $giveOthers = $rows->give_others;
    $bloodType = $rows->blood_type;
    $bloodTypeArray = array(
        'selected' => array( 
            '<option selected>未知</option>',
            '<option selected>A</option>',
            '<option selected>B</option>',
            '<option selected>O</option>',
            '<option selected>AB</option>',
            '<option selected>其他</option>',
        ),
        'unselected' => array(
            '<option>未知</option>',
            '<option>A</option>',
            '<option>B</option>',
            '<option>O</option>',
            '<option>AB</option>',
            '<option>其他</option>',            
        ),
    );
} catch (Exception $e) {
    echoException($e);
}

$returnValue['status'] = 'OK';
$returnValue['residence'] = $residence;
$returnValue['content'] = '
            <div class="page-header">
                <h3>基本资料</h3>
            </div>
            <form class="form-horizontal span8">
                <div class="control-group">
                    <label class="control-label" for="account_name">姓名</label>
                    <div class="controls">
                        <input type="text" id="account_name" placeholder="'.$name.'" disabled>
                        <span class="help-block">姓名默认不可修改，如需修改请联系管理员</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">性别</label>
                    <div class="controls">';
// 判断性别并加入到HTML中
if ($sex == 0) {
    $returnValue['content'] .= '
                        <label class="radio inline">
                            <input value="man" checked="checked" name="account_sex" type="radio">男
                        </label>
                        <label class="radio inline">
                            <input value="woman" name="account_sex" type="radio">女
                        </label>
        ';
} else {
    $returnValue['content'] .= '
                        <label class="radio inline">
                            <input value="man" name="account_sex" type="radio">男
                        </label>
                        <label class="radio inline">
                            <input value="woman" checked="checked" name="account_sex" type="radio">女
                        </label>        
        ';
}

$returnValue['content'] .= '
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">生日</label>
                    <div class="controls">
                        <input type="text" id="account_birthday" value="'.$birthday.'" class="form_datetime" readonly>
                    </div>
                </div>  
                <div class="control-group">
                    <label class="control-label">血型</label>
                    <div class="controls">
                        <select id="account_blood_type">';

for ($i = 0; $i < 6; $i++) {
    if ($i == $bloodType) {
        $returnValue['content'] .= $bloodTypeArray['selected'][$i];
    } else {
        $returnValue['content'] .= $bloodTypeArray['unselected'][$i];
    }
}

$returnValue['content'] .= '
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">居住地址</label>
                    <div class="controls">
                        <input type="text" id="account_residence" value="'.$residence.'">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">给大家的话</label>
                    <div class="controls">
                        <textarea rows="7" class="input-xlarge" id="account_give_others">'.$giveOthers.'</textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls row">
                        <div class="span2">
                            <button class="btn btn-primary btn-block" type="button" onclick="submitAccountBasic()">提交修改</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    ';
echo json_encode($returnValue);


?>
