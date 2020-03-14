<?php
/**
 * 搜索页
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-08-11 05:15:56
 */
include 'config.php';

// 判断当前url
if( strpos($_SERVER['REQUEST_URI'],'search.php') !== false ){
    $url = "/search/".$_GET['keyword'].".html";
    header("Location:$url");
}

// 判断是否有关键字限制
if( $plugin['rules']['search']['min_word'] > 0 && strlen($_GET['keyword']) < $plugin['rules']['search']['min_word'] ){
    $View::assign("message",$plugin['rules']['search']['word_error']);
    $View::display("error");
}

// 解析导航菜单
$View::assign("menu",baseMenu($menu) );

// 搜索结果
$search = $plugin['rules']['search']['main'];
if( $plugin['charset'] == 'gbk' ){
    preg_match("/([\x{4e00}-\x{9fa5}]+)/u",$_GET['url'],$chr);
    $search['url'] = str_replace($chr[1],urlencode(iconv("utf-8","gbk",$chr['1'])),$_GET['url']);
}

if( $search ){
    $searchData = regexMatch($search,'cache/search/'.md5($_GET['url']));
    $View::assign("search",$searchData);

    $seo['title'] = '《'.$_GET['keyword'].'》的搜索结果 - '.$config['title'];
    $seo['keywords'] = '哪里可看看'.$_GET['keyword'].','.$_GET['keyword'].'类似的小说,'.$_GET['keyword'].'的最新章节'.$config['title'];
    $seo['description'] = $config['title'].'供好看的'.$_GET['keyword'].'小说,类似'.$_GET['keyword'].'的小说,'.'免费提供'.$_GET['keyword'].'最新章节全文阅读和'.$_GET['keyword'].'全本txt免费下载。';
    $View::assign('seo',$seo);
}

// 翻页,先判断是否有独立的翻页规则，如果没有则调用公共规则
$pagesRule = $plugin['rules']['search']['main']['page'];
$pagesRule = $pagesRule ?: $plugin['rules']['search']['page'];
if( $pagesRule ){
    $pagesRule['url'] = $search['url'];
    $pagesData = regexMatch($pagesRule,"cache/search/".md5($_GET['url'])."_page");
    $View::assign("pages",$pagesData);
}

$View::display();