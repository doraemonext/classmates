function showAjaxError() {
    hidePopupMessage();
    if (arguments[0] == null) {
        showPopupMessage("bottom-center", "error", "连接服务器失败，请检查您的网络是否正常。如果错误依旧，请联系管理员处理。", 10);
    } else {
        showPopupMessage("bottom-center", "error", "连接服务器失败，请检查您的网络是否正常。如果错误依旧，请联系管理员处理。", arguments[0]);
    }
}

function hidePopupMessage() {
    Messenger().hideAll();
}

function showPopupMessage(position, type, str) {
    hidePopupMessage();
    var time;
    if (arguments[3] == null) {
        time = 3;
    } else {
        time = arguments[3];
    }
    switch (position) {
        case "top-left":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-top messenger-on-left',
                theme: 'future'
            }
            break;
        case "top-center":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-top',
                theme: 'future'
            }
            break;
        case "top-right":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-top messenger-on-right',
                theme: 'future'
            }
            break;
        case "bottom-left":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-left',
                theme: 'future'
            }            
            break;
        case "bottom-center":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-bottom',
                theme: 'future'
            }
            break;
        case "bottom-right":
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-right',
                theme: 'future'
            }
            break;
        default:
            Messenger.options = {
                extraClasses: 'messenger-fixed messenger-on-bottom',
                theme: 'future'
            }
            break;
    }
    
    switch (type) {
        case "info":
            Messenger().post({
                message: str,
                type: 'info',
                hideAfter: time,
                showCloseButton: true
            });
            break;
        case "error":
            Messenger().post({
                message: str,
                type: 'error',
                hideAfter: time,
                showCloseButton: true
            });
            break;
        case "success":
            Messenger().post({
                message: str,
                type: 'success',
                hideAfter: time,
                showCloseButton: true
            });
            break;
        default:
            Messenger().post({
                message: "程序调用非法，请联系管理员进行修复",
                type: 'error',
                hideAfter: 100,
                showCloseButton: true
            });
            break;
    }
}