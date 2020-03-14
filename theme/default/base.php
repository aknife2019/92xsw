<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="applicable-device" content="pc,mobile">
        <meta name="renderer" content="webkit"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-transform"/>
        <meta http-equiv="Cache-Control" content="no-siteapp"/>

        <title>{block name="title"}{$config.title}{/block}</title>
        <meta name="keywords" content="{block name='keywords'}{$config.keywords}{/block}" />
        <meta name="description" content="{block name='description'}{$config.description}{/block}" />
        <link rel="apple-touch-icon-precomposed" href="{__IMG__}logo.ico">
        <meta name="apple-mobile-web-app-title" content="{$config.title}">

        <link rel="stylesheet" href="{__CSS__}bootstrap.min.css">
        <link rel="stylesheet" href="{__CSS__}font-awesome.min.css">
        <link rel="stylesheet" href="{__CSS__}site.css">
        {block name="style"}{/block}

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145419933-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-145419933-1');
        </script>

        <script src="{__JS__}jquery.js"></script>
        <script src="{__JS__}common.js"></script>
        <script src="{__JS__}bootstrap.min.js"></script>
        <script src="{__JS__}common.js"></script>
        <!--[if lt IE 9]>
        <script src="{__JS__}respond.min.js"></script>
        <![endif]-->
        <script src="{__JS__}book.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse" id="header">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{$config.website}" class="navbar-brand logo" title="{$config.title}">{$config.title}</a>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation" id="nav-header">
                    <ul class="nav navbar-nav">
                        {volist name="menu" id="val" key="key"}
                            <li {if condition="strpos($val,preg_replace('/\d+\.html/','',$url)) !== false"}class="active"{/if}><a class="" href="{:baseUrl($val,'cat',1)}">{$key}</a></li>
                        {/volist}
                    </ul>
                </nav>
            </div>
        </div>
        <div class="container body-content">
            {block name="body"}
                正文
            {/block}
            <footer style="text-align:center;">
                <p>本站小说由蜘蛛程序自动抓取各小说网站公开资源，如侵犯了您的权利，请与本站联系，本站将立刻删除 MAIL：{$config.email} </p>
                <p>Copyright © 2019 {$config.title} All Rights Reserved.</p>
            </footer>
        </div>
    </body>
    {block name="script"}{/block}
</html>