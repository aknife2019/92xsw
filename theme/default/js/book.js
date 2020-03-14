// ie7以下的浏览器提示
var isIE = !!window.ActiveXObject;
var isIE6 = isIE && !window.XMLHttpRequest;
var isIE8 = isIE && !!document.documentMode;
var isIE7 = isIE && !isIE6 && !isIE8;
function tip_ie7() {
    if (isIE && (isIE6 || isIE7 || isIE8)) {
        document.writeln("<div class=\"tip-browser-upgrade\">");
        document.writeln("    你正在使用IE低级浏览器，如果你想有更好的阅读体验，<br />强烈建议您立即 <a class=\"blue\" href=\"http://windows.microsoft.com/zh-cn/internet-explorer/download-ie\" target=\"_blank\" rel=\"nofollow\">升级IE浏览器</a> 或者用更快更安全的 <a class=\"blue\" href=\"https://www.google.com/intl/zh-CN/chrome/browser/?hl=zh-CN\" target=\"_blank\" rel=\"nofollow\">谷歌浏览器Chrome</a> 。");
        document.writeln("</div>");
    }
}

//是否移动端
function is_mobile() {
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
    var u = navigator.userAgent;
    if (null == u) {
        return true;
    }
    var result = regex_match.exec(u);
    if (null == result) {
        return false
    } else {
        return true
    }
}

//back to top
function backToTop() {
    document.writeln("<div class=\"back-to-top\" id=\"back-to-top\" title='返回顶部'><i class='fa fa-chevron-up'></i></div>");

    var left = ($(document).width() - $(".body-content").width()) / 2 + $(".body-content").width() + 10;
    if(is_mobile()){
        $("#back-to-top").css({right:10,bottom:"30%"});
    }else{
        $("#back-to-top").css({left: left});
    }

    $(window).resize(function () {
        if ($(document).width() - $(".body-content").width() < 100) {
            $("#back-to-top").hide();
        } else {
            $("#back-to-top").show();
            var left = ($(document).width() - $(".body-content").width()) / 2 + $(".body-content").width() + 10;

            if(is_mobile()){
                $("#back-to-top").css({right:10,bottom:"30%"});
            }else{
                $("#back-to-top").css({left: left});
            }
        }
    });

    var isie6 = window.XMLHttpRequest ? false : true;

    function newtoponload() {
        var c = $("#back-to-top");

        function b() {
            var a = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
            if (a > 100) {
                if (isie6) {
                    c.hide();
                    clearTimeout(window.show);
                    window.show = setTimeout(function () {
                        var d = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
                        if (d > 0) {
                            c.fadeIn(100);
                        }
                    }, 300)
                } else {
                    c.fadeIn(100);
                }
            } else {
                c.fadeOut(100);
            }
        }

        if (isie6) {
            c.style.position = "absolute"
        }
        window.onscroll = b;
        b()
    }

    if (window.attachEvent) {
        window.attachEvent("onload", newtoponload)
    } else {
        window.addEventListener("load", newtoponload, false)
    }
    document.getElementById("back-to-top").onclick = function () {
        window.scrollTo(0, 0)
    };
}
