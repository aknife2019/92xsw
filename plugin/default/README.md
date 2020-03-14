### 此规则支持的源站,仅仅需要修改下分类是否对应即可
> https://www.xssk.la/
> http://www.xs5.la/
> http://www.ddxsw.la/
> http://www.heiyan.us/
> http://www.23wx.io/
> http://www.guli.la/
> http://www.666txt.net/
> http://www.piaotianwx.com/
> https://www.biqukan.net/
> http://www.shukeju.net/
> http://www.wcxsw.net/
> http://www.50zw.cc/
> http://www.u8xs.cc/
> http://www.kanshuge.cc/
> http://www.xinguli.cc/
> http://www.360xs.cc/
***
### 规则说明
***
``` 
{
    # 源站域名，不要带 /
    "url":"https://www.biqukan.net",
    # 规则对应的模版,可以自己写模版也可以调用默认模版
    "theme":"default",
    # 源站编码，用于转码和搜索
    "charset":"gbk",
    # 伪静态规则,规则中必须使用单引号，防止解析错误. 需要双转移符 \\ 
    # TODO:用于后台自动安装插件使用，精简版请手动操作
    # 根据源站url适量修改
    "htaccess":[
        "rewrite '^/index\\.html' /index.php last;",
        "rewrite '^/top\\/(\\w+)\\/(\\d+)\\.html' /top.php?url=/top$1/$2.html last;",
        "rewrite '^/cat\\/wanben\\/(\\d+).html' /category.php?url=/wanben/$1 last;",
        "rewrite '^/cat\\/(.*)' /category.php?url=/$1 last;",
        "rewrite '^/book\\/(\\d+).html' /book.php?url=/book/$1 last;",
        "rewrite '^/show\\/(\\d+)\\/([\\d_]+)\\.html' /show.php?url=/book/$1/$2.html last;",
        "rewrite '^/search\\/(.*).html' /search.php?keyword=$1&url=%2Fmodules%2Farticle%2Fsearch.php%3Fsearchkey%3D$1 last;"
    ],
    # 替换规则
    "replace":{
        # 正则替换规则，主要用于处理重命名的分类名称，可在模版中指定调用
        "regex":{
            "top":["\\/top(\\w+)\\/(\\d+)\\.html","/top/$1/$2.html"],
            "cat":["\\/(fenlei\\d+|wanben)\\/(\\d+)","/cat/$1/$2","1,2"],
            "book":["\\/book\\/(\\d+)\\/","/book/$1.html"],
            "show":["\\/book\\/(\\d+)\\/([\\d_]+)\\.html","/show/$1/$2.html"]
        },
        # 字符串替换，主要用于内容处理
        "text":{
            "一秒记住【笔趣看 www.biqukan.net】，":"一秒记住【就爱小说网 92xsw.cn】",
            "（":"",
            "）":"",
            "https://www.biqukan.net/":"/"
        },
        # url替换，主要用于url处理，所以与text分开
        "url":{
            "fenlei1":"xuanhuan",
            "fenlei2":"xiuzhen",
            "fenlei3":"dushi",
            "fenlei4":"yanqing",
            "fenlei5":"lishi",
            "fenlei6":"wangyou",
            "fenlei7":"kehuan",
            "fenlei8":"kongbu",
            "topallvisit":"top/allvisit",
            "topallvote":"top/allvote",
            "topmonthvisit":"top/monthvisit",
            "topmonthvote":"top/monthvote",
            "topweekvisit":"top/weekvisit",
            "topweekvote":"top/weekvote",
            "toppostdate":"top/postdate",
            "toplastupdate":"top/lastupdate",
            "topgoodnum":"top/goodnum",
            "topsize":"top/size",
            "toptoptime":"top/toptime"
        },
        # url反向解析替换
        "deurl":{
            "xuanhuan":"fenlei1",
            "xiuzhen":"fenlei2",
            "dushi":"fenlei3",
            "yanqing":"fenlei4",
            "lishi":"fenlei5",
            "wangyou":"fenlei6",
            "kehuan":"fenlei7",
            "kongbu":"fenlei8"
        }
    },
    # 导航菜单
    "menu":{
        "首页":"/index.html",
        "玄幻小说":"/fenlei1/1.html",
        "修真小说":"/fenlei2/1.html",
        "都市小说":"/fenlei3/1.html",
        "言情小说":"/fenlei4/1.html",
        "历史小说":"/fenlei5/1.html",
        "网游小说":"/fenlei6/1.html",
        "科幻小说":"/fenlei7/1.html",
        "恐怖灵异":"/fenlei8/1.html",
        "完本小说":"/wanben/1",
        # 如果有子元素，则第一个是此导航菜单的默认页
        # 如，点击排行榜，那么肯定是 [总排行榜],内页要显示出子菜单
        "排行榜":{
            "总排行榜":"/top/allvisit/1.html",
            "总推荐榜":"/top/allvote/1.html",
            "月排行榜":"/top/monthvisit/1.html",
            "月推荐榜":"/top/monthvote/1.html",
            "周排行榜":"/top/weekvisit/1.html",
            "周推荐榜":"/top/weekvote/1.html",
            "最新入库":"/top/postdate/1.html",
            "最近更新":"/top/lastupdate/1.html",
            "总收藏榜":"/top/goodnum/1.html",
            "字数排行":"/top/size/1.html",
            "本站推荐":"/top/toptime/1.html"
        }
    },
    # 解析规则
    "rules":{
        # 首页规则
        "index":{
            # 本站推荐
            "hot":{
                # 源站url
                "url":"/",
                # 缓存时间
                "cache":"60*24",
                # 取出的数量
                "limit":"8",
                # querylist 规则范围
                "range":".panel-body .col-md-3.col-xs-6.mb10.mt10",
                # querylist 列表规则
                "regex":{
                    "book":"a .caption strong",
                    "book_url":"a@href",
                    "image":"a img@src",
                    "author":"a .caption .text-muted.fs-12"
                }
            },
            # 推荐右侧列表
            "hot_list":{
                # 源站url
                "url":"/",
                # 缓存时间
                "cache":"60*24",
                # 取出的数量
                "limit":"15",
                # querylist 规则范围
                "range":"#tab-weekvisit ul li",
                # querylist 列表规则
                "regex":{
                    "book":"a",
                    "book_url":"a@href",
                    "author":"small"
                }
            },
            # 最近更新
            "newupdate":{
                # 源站url
                "url":"/",
                # 缓存时间
                "cache":"10",
                # querylist 规则范围
                "range":".row table:eq(0) tr",
                # querylist 列表规则
                "regex":{
                    "cat":"td:eq(0)",
                    "book":"td:eq(1) a",
                    "book_url":"td:eq(1) a@href",
                    "show":"td:eq(2) a",
                    "show_url":"td:eq(2) a@href",
                    "author":"td:eq(3)",
                    "time":"td:eq(4)"
                }
            },
            # 最新入库
            "newlist":{
                # 源站url
                "url":"/",
                # 缓存时间
                "cache":"60",
                # querylist 规则范围
                "range":".row table:eq(1) tr",
                # querylist 列表规则
                "regex":{
                    "cat":"td:eq(0)",
                    "book":"td:eq(1) a",
                    "book_url":"td:eq(1) a@href",
                    "author":"td:eq(2)"
                }
            }
        },
        # 主要列表
        "list":{
            # 翻页规则，如果对应的规则包含page，掉调用，否则调用上级规则
            "page":{
                "cache":"60*24*7",
                "range":"#pagelink li",
                # 排除的数组顺序，比如一个数组为[a,b,c,d,e],"0|3"的结果为[b,c,e]
                "exclude":"0|1|",
                "regex":{
                    "now":"span",
                    "title":"a|span",
                    "title_url":"a@href"
                }
            },
            "sidebar":{
                "cache":"60",
                "limit":"29",
                "range":".list-top li",
                "regex":{
                    "book":"a",
                    "book_url":"a@href",
                    "author":"small"
                }
            },
            "main":{
                "cache":"10",
                "range":".table tr",
                # 如果包含exception，且url包含对应值的字符串，则调用对应值的规则。比如不同分类不同展示样式，那么规则就不同
                "exception":"wanben",
                "regex":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "show":"td:eq(1) a",
                    "show_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "time":"td:eq(3)",
                    "type":"td:eq(4)"
                },
                "wanben":{
                    "book":"td:eq(1) a",
                    "book_url":"td:eq(1) a@href",
                    "show":"td:eq(2) a",
                    "show_url":"td:eq(2) a@href",
                    "author":"td:eq(3)",
                    "time":"td:eq(4)",
                    "type":"td:eq(5)"
                }
            },
            "top":{
                "cache":"10",
                "range":".table tr",
                "exception":"toppostdate,toplastupdate,toptoptime",
                "regex":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "show":"td:eq(1) a",
                    "show_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "time":"td:eq(4)",
                    "type":"td:eq(5)"
                },
                "toppostdate":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "show":"td:eq(1) a",
                    "show_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "time":"td:eq(3)",
                    "type":"td:eq(4)"
                },
                "toplastupdate":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "show":"td:eq(1) a",
                    "show_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "time":"td:eq(3)",
                    "type":"td:eq(4)"
                },
                "toptoptime":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "show":"td:eq(1) a",
                    "show_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "time":"td:eq(3)",
                    "type":"td:eq(4)"
                }
            }
        },
        "book":{
            "info":{
                "cache":"60",
                "range":".panel-body:eq(0) .row",
                "regex":{
                    "img":"img.img-thumbnail@src",
                    "title":".bookTitle",
                    "author":"div:eq(1) .booktag a:eq(0)",
                    "category":"div:eq(1) .booktag a:eq(1)",
                    "number":"div:eq(1) .booktag span:eq(0)",
                    "type":"div:eq(1) .booktag span:eq(2)",
                    "newchapter":"div:eq(1) p:eq(1) a",
                    "newchapter_url":"div:eq(1) p:eq(1) a@href",
                    "time":"div:eq(1) p:eq(1) span",
                    "desc":"#bookIntro"
                }
            },
            "newchapter":{
                "cache":"60",
                "range":".panel-body:eq(1) dd",
                "regex":{
                    "show":"a",
                    "show_url":"a@href"
                }
            },
            "chapter":{
                "cache":"60",
                "range":".panel-body:eq(2) dd",
                "regex":{
                    "show":"a",
                    "show_url":"a@href"
                }
            }
        },
        "show":{
            "page":{
                "cache":"60*24*30",
                "range":".readPager",
                "regex":{
                    "prev":"#linkPrev",
                    "prev_url":"#linkPrev@href",
                    "chapter":"#linkIndex",
                    "chapter_url":"#linkIndex@href",
                    "next":"#linkNext",
                    "next_url":"#linkNext@href"
                }
            },
            "content":{
                "cache":"60*24*30",
                "range":"body",
                "regex":{
                    "catgory":".breadcrumb li:eq(1) a",
                    "catgory_url":".breadcrumb li:eq(1) a@href",
                    "book":".breadcrumb li:eq(2) a",
                    "book_url":".breadcrumb li:eq(2) a@href",
                    "title":".page-header h1",
                    "html":"#htmlContent@html"
                }
            }
        },
        "search":{
            # 搜索字符最小限制
            "min_word":"4",
            # 如果不达标则显示以下错误提示
            "word_error":"对不起，搜索关键字请不要少于 4 个字节",
            "page":{
                "cache":"60*24*7",
                "range":"#pagelink li",
                "exclude":"0|1|",
                "regex":{
                    "now":"span",
                    "title":"a|span",
                    "title_url":"a@href"
                }
            },
            "main":{
                "cache":"60*30",
                "range":"table tr",
                "regex":{
                    "book":"td:eq(0) a",
                    "book_url":"td:eq(0) a@href",
                    "chapter":"td:eq(1) a",
                    "chapter_url":"td:eq(1) a@href",
                    "author":"td:eq(2)",
                    "number":"td:eq(3)",
                    "time":"td:eq(4)",
                    "type":"td:eq(5)"
                }
            }
        }
    }
}
```