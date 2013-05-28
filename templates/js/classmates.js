
window.onload = function() {
    navigationMotto();
    displayUsername();
}

// 在页面加载后显示导航条上的座右铭
function navigationMotto()
{
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
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

// 当用户登录的情况下，更新用户名
function displayUsername() {
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/display_username.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { displayUsernameResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function displayUsernameResult(xmlHttp) {
    if (xmlHttp.readyState == 4) {
        var username = xmlHttp.responseText;
        if (username == -1) {
            window.location.href = "error.php?content=Cookie有误，请您删除所有Cookie后重新登录尝试";
        } else {
            var root = document.getElementById('index_username');
            var text = document.createTextNode(username);
            root.appendChild(text);
        }
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