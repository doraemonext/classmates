
function showPopupMessage(position, type, str) {
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
                hideAfter: 3,
                showCloseButton: true
            });
            break;
        case "error":
            Messenger().post({
                message: str,
                type: 'error',
                hideAfter: 3,
                showCloseButton: true
            });
            break;
        case "success":
            Messenger().post({
                message: str,
                type: 'success',
                hideAfter: 3,
                showCloseButton: true
            });
            break;
        default:
            Messenger().post({
                message: "程序调用非法，请联系管理员进行修复",
                type: 'error',
                hideAfter: 10,
                showCloseButton: true
            });
            break;
    }
}