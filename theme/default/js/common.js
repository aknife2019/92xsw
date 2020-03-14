function addFav() {
    var url = window.location.href;
    var title = window.document.title;
    if (confirm("收藏名称：" + title + "\n收藏网址：" + url + "\n确定添加收藏？")) {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf("msie 8") > -1) {
            window.external.addToFavoritesBar(url, title);
        } else {
            try {
                window.external.addFavorite(url, title)
            } catch (e) {
                try {
                    window.sidebar.addPanel(title, url, "");
                } catch (e) {
                    alert("加入收藏失败，请使用Ctrl+D进行添加")
                }
            }
        }
    }
}
function setCookie(name,value){
    var Days = 30; 
    var expire = new Date(); 
    expire.setTime(expire.getTime() + Days*24*60*60*1000); 
    document.cookie = name + "=" + escape(value) + ';expires='+expire.toGMTString()+'; path=/';

}
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg)){
        return unescape(arr[2]); 
    }else{
        return null; 
    }
}