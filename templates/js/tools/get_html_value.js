function getHtmlValue() {
    this.textValueById = function(id) {
        return document.getElementById(id).value;
    }
    this.selectIndexById = function(id) {
        return document.getElementById(id).selectedIndex;
    }
    this.radioValueByName = function(name) {
        var object = document.getElementsByName(name);
        if (object != null) {
            for (var i = 0; i < object.length; i++) {
                if (object[i].checked) {
                    return object[i].value;
                }
            }
        }
        return null;
    }
}



