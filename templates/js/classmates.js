// 验证输入的bootstrap库
$(document).ready(function() {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
});    

window.onload = function() {
    navigationMotto();
    displayAccount();
    displayIndexWriting();
    displayIndexPicture();
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
function navigationMottoResult(xmlHttp) {
    if (xmlHttp.readyState == 4) {
        var info = JSON.parse(xmlHttp.responseText);
        var root = document.getElementById('navigation_motto');
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

// 当用户登录的情况下，更新用户名及头像
function displayAccount() {
    // 判断用户是否处于登录状态
    if (document.getElementById('header_username') == null) {
        return;
    }
    
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/display_account.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { displayAccountResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function displayAccountResult(xmlHttp) {
    if (xmlHttp.readyState == 4) {
        var info = JSON.parse(xmlHttp.responseText);
        if (info["status"] == "ERROR") {
            window.location.href = "error.php?content=" + info["statusInfo"];
            return;
        } 
        
        var username = info["username"];
        var avatar = info["avatar"];
        
        var usernameRoot = document.getElementById('header_username');
        var usernameText = document.createTextNode(username);
        clearChildNode(usernameRoot);
        usernameRoot.appendChild(usernameText);
        
        var avatarRoot = document.getElementById('header_username_avatar');
        avatarRoot.src = avatar + "?timestamp=" + Date();
    }
}

// 在登录时显示登录进度
function displayLoginInfo() {
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var username = document.getElementById('login_username').value;
    var password = document.getElementById('login_password').value;
    var salt = getSalt();
    var finalPassword = md5(md5(password) + salt);
    var sendData = "username=" + encodeURIComponent(username) + 
            "&password=" + encodeURIComponent(finalPassword) + 
            "&salt=" + encodeURIComponent(salt);
    
    xmlHttp.onreadystatechange = function() { displayLoginInfoResult(xmlHttp); };
    xmlHttp.open("POST", "login.php", true);
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlHttp.send(sendData);
}
function displayLoginInfoResult(xmlHttp) {
    var root = document.getElementById('login_info');
    if (xmlHttp.readyState < 4) {
        var text = document.createTextNode('正在登录中，请稍候……');
        root.style.display = 'block';
        root.setAttribute("class", "alert alert-info");
        clearChildNode(root);
        root.appendChild(text);
    } 
    
    var info = JSON.parse(xmlHttp.responseText);
    if (info["status"] == "OK") { 
        var text = document.createTextNode('登录成功，正在跳转……');
        root.style.display = 'block';
        root.setAttribute("class", "alert alert-success");
        clearChildNode(root);
        root.appendChild(text);
        window.location.href = "index.php";
    } else if (info["status"] == "ERROR") {
        var text = document.createTextNode(info["statusInfo"]);
        root.style.display = 'block';
        root.setAttribute("class", "alert alert-error");
        clearChildNode(root);
        root.appendChild(text);
    }
}

// 删除节点root的所有子节点
function clearChildNode(root) {
    var child = root.childNodes;
    for (var i = child.length - 1; i >= 0; i--) {
        root.removeChild(child[i]);
    }
}

// 得到服务器此时的session_id
function getSalt() {
    var xmlHttp = getXmlHttpObject();
    var salt;
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/get_salt.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4) {
            salt = xmlHttp.responseText;
        }
    };
    xmlHttp.open("GET", url, false);
    xmlHttp.send(null);
    return salt;
}

// 使得用户安全退出，销毁session
function logout() {
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/logout.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4) {
            if (xmlHttp.responseText == "OK") {
                window.location.reload();
            }
        }
    };
    xmlHttp.open("GET", url, false);
    xmlHttp.send(null);
}

// 显示首页图片轮播右侧的文字
function displayIndexWriting() {
    // 当并非首页的时候，不显示文字
    if (document.getElementById('index_writing') == null) {
        return;
    }
    
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/get_index_writing.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { displayIndexWritingResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function displayIndexWritingResult(xmlHttp) {
    var root = document.getElementById('index_writing');
    if (xmlHttp.readyState < 4) {
        var text = document.createTextNode('正在加载中，请稍候……');
        clearChildNode(root);
        root.appendChild(text);
    } 
    
    clearChildNode(root);
    root.innerHTML = xmlHttp.responseText;
}

function displayIndexPicture() {
    if (document.getElementById('index_picture_navigation') == null) {
        return;
    }
    
    var xmlHttp = getXmlHttpObject();
    if (xmlHttp == null) {
        window.location.href = "error.php?content=您的浏览器不支持 HTTP Request，请您升级浏览器后再访问 ^_^";
        return;
    }
    
    var url = "response/get_index_picture.php";
    url = url + "?sid=" + Math.random();
    xmlHttp.onreadystatechange = function() { displayIndexPictureResult(xmlHttp); };
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
function displayIndexPictureResult(xmlHttp) {
    var rootNavigation = document.getElementById("index_picture_navigation");
    var rootUrl = document.getElementById("index_picture_url");
    if (xmlHttp.readyState == 4) {
        var info = JSON.parse(xmlHttp.responseText);
        var total = info["total"];
        var li;
        
        clearChildNode(rootNavigation);
        for (var i = 0; i < total; i++) {
            li = document.createElement("li");
            li.setAttribute("data-target", "#pic_carousel");
            li.setAttribute("data-slide-to", i);
            if (i == 0) {
                li.setAttribute("class", "active");
            }
            rootNavigation.appendChild(li);
        }
        
        var div, img;
        clearChildNode(rootUrl);
        for (var i = 0; i < total; i++) {
            div = document.createElement("div");
            img = document.createElement("img");
            if (i == 0) {
                div.setAttribute("class", "active item");
            } else {
                div.setAttribute("class", "item");
            }
            img.src = info["img"][i];
            
            rootUrl.appendChild(div);
            div.appendChild(img);
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

// 依赖函数
function md5(str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // + namespaced by: Michael White (http://getsprink.com)
  // +    tweaked by: Jack
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // -    depends on: utf8_encode
  // *     example 1: md5('Kevin van Zonneveld');
  // *     returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'
  var xl;

  var rotateLeft = function (lValue, iShiftBits) {
    return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
  };

  var addUnsigned = function (lX, lY) {
    var lX4, lY4, lX8, lY8, lResult;
    lX8 = (lX & 0x80000000);
    lY8 = (lY & 0x80000000);
    lX4 = (lX & 0x40000000);
    lY4 = (lY & 0x40000000);
    lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
    if (lX4 & lY4) {
      return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
    }
    if (lX4 | lY4) {
      if (lResult & 0x40000000) {
        return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
      } else {
        return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
      }
    } else {
      return (lResult ^ lX8 ^ lY8);
    }
  };

  var _F = function (x, y, z) {
    return (x & y) | ((~x) & z);
  };
  var _G = function (x, y, z) {
    return (x & z) | (y & (~z));
  };
  var _H = function (x, y, z) {
    return (x ^ y ^ z);
  };
  var _I = function (x, y, z) {
    return (y ^ (x | (~z)));
  };

  var _FF = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _GG = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _HH = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _II = function (a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var convertToWordArray = function (str) {
    var lWordCount;
    var lMessageLength = str.length;
    var lNumberOfWords_temp1 = lMessageLength + 8;
    var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - (lNumberOfWords_temp1 % 64)) / 64;
    var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
    var lWordArray = new Array(lNumberOfWords - 1);
    var lBytePosition = 0;
    var lByteCount = 0;
    while (lByteCount < lMessageLength) {
      lWordCount = (lByteCount - (lByteCount % 4)) / 4;
      lBytePosition = (lByteCount % 4) * 8;
      lWordArray[lWordCount] = (lWordArray[lWordCount] | (str.charCodeAt(lByteCount) << lBytePosition));
      lByteCount++;
    }
    lWordCount = (lByteCount - (lByteCount % 4)) / 4;
    lBytePosition = (lByteCount % 4) * 8;
    lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
    lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
    lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
    return lWordArray;
  };

  var wordToHex = function (lValue) {
    var wordToHexValue = "",
      wordToHexValue_temp = "",
      lByte, lCount;
    for (lCount = 0; lCount <= 3; lCount++) {
      lByte = (lValue >>> (lCount * 8)) & 255;
      wordToHexValue_temp = "0" + lByte.toString(16);
      wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
    }
    return wordToHexValue;
  };

  var x = [],
    k, AA, BB, CC, DD, a, b, c, d, S11 = 7,
    S12 = 12,
    S13 = 17,
    S14 = 22,
    S21 = 5,
    S22 = 9,
    S23 = 14,
    S24 = 20,
    S31 = 4,
    S32 = 11,
    S33 = 16,
    S34 = 23,
    S41 = 6,
    S42 = 10,
    S43 = 15,
    S44 = 21;

  str = this.utf8_encode(str);
  x = convertToWordArray(str);
  a = 0x67452301;
  b = 0xEFCDAB89;
  c = 0x98BADCFE;
  d = 0x10325476;

  xl = x.length;
  for (k = 0; k < xl; k += 16) {
    AA = a;
    BB = b;
    CC = c;
    DD = d;
    a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
    d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
    c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
    b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
    a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
    d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
    c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
    b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
    a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
    d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
    c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
    b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
    a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
    d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
    c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
    b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
    a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
    d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
    c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
    b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
    a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
    d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
    c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
    b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
    a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
    d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
    c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
    b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
    a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
    d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
    c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
    b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
    a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
    d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
    c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
    b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
    a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
    d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
    c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
    b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
    a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
    d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
    c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
    b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
    a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
    d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
    c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
    b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
    a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
    d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
    c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
    b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
    a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
    d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
    c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
    b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
    a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
    d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
    c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
    b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
    a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
    d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
    c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
    b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
    a = addUnsigned(a, AA);
    b = addUnsigned(b, BB);
    c = addUnsigned(c, CC);
    d = addUnsigned(d, DD);
  }

  var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);

  return temp.toLowerCase();
}
function utf8_encode (argString) {
  // http://kevin.vanzonneveld.net
  // +   original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: sowberry
  // +    tweaked by: Jack
  // +   bugfixed by: Onno Marsman
  // +   improved by: Yves Sucaet
  // +   bugfixed by: Onno Marsman
  // +   bugfixed by: Ulrich
  // +   bugfixed by: Rafal Kukawski
  // +   improved by: kirilloid
  // +   bugfixed by: kirilloid
  // *     example 1: utf8_encode('Kevin van Zonneveld');
  // *     returns 1: 'Kevin van Zonneveld'

  if (argString === null || typeof argString === "undefined") {
    return "";
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
         (c1 >> 6)        | 192,
        ( c1        & 63) | 128
      );
    } else if (c1 & 0xF800 != 0xD800) {
      enc = String.fromCharCode(
         (c1 >> 12)       | 224,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    } else { // surrogate pairs
      if (c1 & 0xFC00 != 0xD800) { throw new RangeError("Unmatched trail surrogate at " + n); }
      var c2 = string.charCodeAt(++n);
      if (c2 & 0xFC00 != 0xDC00) { throw new RangeError("Unmatched lead surrogate at " + (n-1)); }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
         (c1 >> 18)       | 240,
        ((c1 >> 12) & 63) | 128,
        ((c1 >> 6)  & 63) | 128,
        ( c1        & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}
