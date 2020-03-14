<?php
/**
 * 分类
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-08-11 05:03:57
 */
include 'config.php';

// 解析导航菜单
$View::assign("menu",baseMenu($menu) );

// 解析url
$url = decodeUrl($_GET['url']);
$View::assign('url',$_GET['url']);


// 根据解析的url，获取当前分类的名称，并设置seo数据
$category = getCategorySeo($_GET['url'],$plugin['menu']);
if( $category ){
    $seo['title'] = $category.'_'.$config['title'];
    $seo['keywords'] = '好看的'.$category.','.date('Y',time()).$category.'排行榜,玄幻小说,'.$config['title'];
    $seo['description'] = $config['title'].'供好看的'.$category.'排行榜,'.$config['title'].'免费提供'.$category.'最新章节全文阅读和'.$category.'全本txt免费下载。';
    $View::assign('seo',$seo);
}

// 最新main
$main = $plugin['rules']['list']['main'];
$main['url'] = $url;

if( $main ){
    $mainData = regexMatch($main,"cache/cat/".md5($_GET['url'])."_main");
    $View::assign("main",$mainData);
}

// 最新侧栏
$sidebar = $plugin['rules']['list']['sidebar'];
$sidebar['url'] = $url;

if( $sidebar ){
    $sidebarData = regexMatch($sidebar,"cache/cat/".md5($_GET['url'])."_sidebar");
    $View::assign("sidebar",$sidebarData);
}

// 翻页,先判断是否有独立的翻页规则，如果没有则调用公共规则
$pagesRule = $plugin['rules']['list']['main']['page'];
$pagesRule = $pagesRule ?: $plugin['rules']['list']['page'];
if( $pagesRule ){
    $pagesRule['url'] = $url;
    $pagesData = regexMatch($pagesRule,"cache/cat/".md5($_GET['url'])."_page");
    $View::assign("pages",$pagesData);
}

$View::display();