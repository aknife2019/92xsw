<?php
/**
 * 书详情
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-08-11 03:07:27
 */
include 'config.php';

// 解析导航菜单
$View::assign("menu",baseMenu($menu) );

// 解析url
$url = decodeUrl($_GET['url']);
$View::assign("url",$url);

// 书本描述
$info = $plugin['rules']['book']['info'];
$info['url'] = $url;

if( $info ){
    $infoData = regexMatch($info,"cache/book/".md5($_GET['url'])."_info");
    $View::assign("info",$infoData[0]);

    $seo['title'] = $infoData[0]['title'].'('.$infoData[0]['author'].')最新章节 全文阅读 无弹窗广告-'.$config['title'];
    $seo['keywords'] = $infoData[0]['title'].','.$infoData[0]['title'].'最新章节,'.$infoData[0]['title'].'全文阅读,'.$infoData[0]['title'].'无弹窗广告,'.$infoData[0]['author'].','.$infoData[0]['category'].','.$config['title'];
    $seo['description'] = $infoData[0]['title'].'是'.$infoData[0]['author'].'的经典'.$infoData[0]['category'].'类作品，'.$infoData[0]['title'].'主要讲述了：'.$infoData[0]['desc'].'，'.$config['title'].'提供'.$infoData[0]['title'].'最新章节全文免费阅读和全集txt免费下载！';
    $View::assign('seo',$seo);
}

// 最新章节列表
$newchapter = $plugin['rules']['book']['newchapter'];
$newchapter['url'] = $url;
if( $newchapter ){
    $newchapterData = regexMatch($newchapter,"cache/book/".md5($_GET['url'])."_newchapter");
    $View::assign("newchapter",$newchapterData);
}

// 所有章节列表
$chapter = $plugin['rules']['book']['chapter'];
$chapter['url'] = $url;
if( $chapter ){
    $chapterData = regexMatch($chapter,"cache/book/".md5($_GET['url'])."_chapter");
    $View::assign("chapter",$chapterData);
}

$View::display();