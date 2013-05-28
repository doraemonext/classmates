
// 在页面加载后显示导航条上的座右铭
window.onload = function navigationMotto()
{
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        navigationMottoError(["您的浏览器不支持 HTTP Request", "请升级浏览器后再访问本站 ^_^"]);
        return;
    }
    
    var url = "response/navigation_motto.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { navigationMottoResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
// 导航条上座右铭的ajax回调函数
function navigationMottoResult(xmlHttp) {
    if (xmlHttp.readyState == 4) {
        var info = JSON.parse(xmlHttp.responseText);
        var root = document.getElementById('navigationMotto');
        var ul = document.createElement('ul');
        root.appendChild(ul);
        for (var i = 0; i < info.length; i++) {
            var li = document.createElement('li');
            var text = document.createTextNode(info[i]);
            ul.appendChild(li);
            li.appendChild(text);
        }
    }
}
// 当XMLHttpRequest()请求失败时，返回错误信息
function navigationMottoError(error_message)
{
    var err_root = document.getElementById('navigationMotto');
    var err_ul = document.createElement('ul');
    err_root.appendChild(err_ul);
    for (var i = 0; i < error_message.length; i++) {
        var err_li = document.createElement('li');
        var err_text = document.createTextNode(error_message[i]);
        err_ul.appendChild(err_li);
        err_li.appendChild(err_text);
    }
}

// Ajax getXmlHttpObject function
function getXmlHttpObject()
{
    var xmlHttp = null;
    try {
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}