{
    "url":"http://www.xinguli.cc",
    "theme":"default",
    "charset":"gbk",
    "htaccess":[
        "rewrite '^/index\\.html' /index.php last;",
        "rewrite '^/top\\/(\\w+)\\/(\\d+)\\.html' /top.php?url=/top$1/$2.html last;",
        "rewrite '^/cat\\/wanben\\/(\\d+).html' /category.php?url=/wanben/$1 last;",
        "rewrite '^/cat\\/(.*)' /category.php?url=/$1 last;",
        "rewrite '^/book\\/(\\d+).html' /book.php?url=/book/$1 last;",
        "rewrite '^/show\\/(\\d+)\\/([\\d_]+)\\.html' /show.php?url=/book/$1/$2.html last;",
        "rewrite '^/search\\/(.*).html' /search.php?keyword=$1&url=%2Fmodules%2Farticle%2Fsearch.php%3Fsearchkey%3D$1 last;"
    ],
    "replace":{
        "regex":{
            "top":["\\/top(\\w+)\\/(\\d+)\\.html","/top/$1/$2.html"],
            "cat":["\\/(fenlei\\d+|wanben)\\/(\\d+)","/cat/$1/$2","1,2"],
            "book":["\\/book\\/(\\d+)\\/","/book/$1.html"],
            "show":["\\/book\\/(\\d+)\\/([\\d_]+)\\.html","/show/$1/$2.html"]
        },
        "text":{
            "新谷粒网 www.xinguli.cc，":"就爱小说网 92xsw.cn",
            "（":"",
            "）":"",
            "https://www.biqukan.net/":"/"
        },
        "url":{
           "fenlei1":"xuanhuan",
            "fenlei2":"xiuzhen",
            "fenlei3":"dushi",
            "fenlei4":"yanqing",
            "fenlei5":"lishi",
            "fenlei6":"wangyou",
            "fenlei7":"kehuan",
            "fenlei8":"kongbu"
        },
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
    "menu":{
        "玄幻小说":"/cat/xuanhuan/1.html",
        "修真小说":"/cat/xiuzhen/1.html",
        "都市小说":"/cat/dushi/1.html",
        "言情小说":"/cat/yanqing/1.html",
        "历史小说":"/cat/lishi/1.html",
        "网游小说":"/cat/wangyou/1.html",
        "科幻小说":"/cat/kehuan/1.html",
        "恐怖灵异":"/cat/kongbu/1.html",
        "完本小说":"/cat/wanben/1",
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
            "字数排行":"/top/size/1.html"
        }
    },
    "rules":{
        "index":{
            "hot":{
                "url":"/",
                "cache":"60*24",
                "limit":"8",
                "range":".panel-body .col-md-3.col-xs-6.mb10.mt10",
                "regex":{
                    "book":"a .caption strong",
                    "book_url":"a@href",
                    "image":"a img@src",
                    "author":"a .caption .text-muted.fs-12"
                }
            },
            "hot_list":{
                "url":"/",
                "cache":"60*24",
                "limit":"15",
                "range":"#tab-weekvisit ul li",
                "regex":{
                    "book":"a",
                    "book_url":"a@href",
                    "author":"small"
                }
            },
            "newupdate":{
                "url":"/",
                "cache":"10",
                "range":".row table:eq(0) tr",
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
            "newlist":{
                "url":"/",
                "cache":"60",
                "range":".row table:eq(1) tr",
                "regex":{
                    "cat":"td:eq(0)",
                    "book":"td:eq(1) a",
                    "book_url":"td:eq(1) a@href",
                    "author":"td:eq(2)"
                }
            }
        },
        "list":{
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
            "min_word":"4",
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
