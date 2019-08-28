let ajax = {
    setAjax: function() {
        try {
            return new XMLHttpRequest();
        } catch (e) {
            try {
                return new ActiveXObject("Msxml12.XMLHTTP");
            } catch (e) {
                try {
                    return new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                    alert("Your browser can't support a picture preview");
                    return false;
                }
            }
        }
    },
}

export default ajax;