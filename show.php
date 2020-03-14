<?php
/**
 * 内容
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-08-11 03:54:44
 */
include 'config.php';

// 解析导航菜单
$View::assign("menu",baseMenu($menu) );

// 解析url
$url = decodeUrl($_GET['url']);

// 书本描述
$content = $plugin['rules']['show']['content'];
$content['url'] = $url;

if( $content ){
    $contentData = regexMatch($content,"cache/show/".md5($_GET['url'])."_content");
    $View::assign("content",$contentData[0]);

    $seo['title'] = $contentData[0]['title'].'_'.$contentData[0]['book'].'_'.$config['title'];
    preg_match('/(.*)( \(?)/',$contentData[0]['title'],$book_title);
    $seo['keywords'] = $book_title[1].','
    .$contentData[0]['book'].','.$config['title'];
    $seo['description'] = $config['title'].'提供'.$contentData[0]['book'].'最新章节《'.$book_title[1].'》免费在线阅读。本章大概讲述了：'.getContentDesc($contentData[0]['html']);

    $View::assign('seo',$seo);
}

// 翻页
$page = $plugin['rules']['show']['page'];
$page['url'] = $url;
if( $page ){
    $pageData = regexMatch($page,"cache/show/".md5($_GET['url'])."_page");
    $View::assign("page",$pageData[0]);
}

$View::display();