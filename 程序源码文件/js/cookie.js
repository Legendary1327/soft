//设置cookie
function setCookie(name,value){
    // var date = new Date();
    // date.setDate(date.getDate() + day);
    document.cookie = name + "=" + value + ";";
}

//获取cookie
// function getCookie(name){
//     var reg = RegExp(name+'=([^;]+)');
//     // document.cookie.
//     var arr = document.cookie.match(reg);
//     if(arr){
//         return arr[1];
//     }else {
//         return '';
//     }
// }
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");

    if (arr = document.cookie.match(reg))

        return unescape(arr[2]);
    else
        return null;
}

//删除cookie
function delCookie(name){
    setCookie(name,null,-1);
}

function isNumber(value) {         //验证是否为数字
    var patrn = /^(-)?\d+(\.\d+)?$/;
    if (patrn.exec(value) == null || value == "") {
        return false
    } else {
        return true
    }
}