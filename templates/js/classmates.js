// Index

window.onload = function navigationMotto()
{
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        navigationMottoError('您的浏览器不支持 HTTP Request', '请升级浏览器后再访问本站 ^_^');
        return;
    }
    
    var url = "response/navigation_motto.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { navigationMottoResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function navigationMottoResult(xmlHttp) {
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        var root = document.getElementById('navigationMotto');
        var ul = document.createElement('ul');
        root.appendChild(ul);
        ul.innerHTML = xmlHttp.responseText;
    }
}
function navigationMottoError(error_message_1, error_message_2) 
{
    var err_root = document.getElementById('navigationMotto');
    var err_ul = document.createElement('ul');
    var err_li_1 = document.createElement('li');
    var err_text_1 = document.createTextNode(error_message_1);
    var err_li_2 = document.createElement('li');
    var err_text_2 = document.createTextNode(error_message_2);
    err_root.appendChild(err_ul);
    err_ul.appendChild(err_li_1);
    err_ul.appendChild(err_li_2);
    err_li_1.appendChild(err_text_1);
    err_li_2.appendChild(err_text_2);
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