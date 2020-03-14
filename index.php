<?php
/**
 * 首页
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-07-22 02:04:22
 */
include 'config.php';

// 解析导航菜单
$View::assign("menu",baseMenu($menu) );

// 解析首页推荐
$hot = $plugin['rules']['index']['hot'];
if( $hot ){
    $hotData = regexMatch($hot,'cache/index_hot');
    $View::assign("hot",$hotData);
}

$hotList = $plugin['rules']['index']['hot_list'];
if( $hotList ){
    $hotList1Data = regexMatch($hotList,'cache/index_hotList');
    $View::assign("hotList",$hotList1Data);
}
// 最新更新
$newupdate = $plugin['rules']['index']['newupdate'];
if( $newupdate ){
    $newupdateData = regexMatch($newupdate,'cache/index_newupdate');
    $View::assign("newupdate",$newupdateData);
}

// 最新入库
$newlist = $plugin['rules']['index']['newlist'];
if( $newlist ){
    $newlistData = regexMatch($newlist,'cache/index_newlist');
    $View::assign("newlist",$newlistData);
}

$View::display();