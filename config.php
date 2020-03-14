<?php
/**
 * 配置文件
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-08-10 22:49:44
 */

// 配置文件
$config = [
    "website"       =>  "http://92xsw.local",
    "title"         =>  "就爱小说网",
    "keywords"      =>  "就爱小说网,没有广告的小说网,无广告小说网",
    "email"         =>  "admin#92xsw.com",
    "description"   =>  "就爱小说网(92xsw.cn)为您提供一个没有弹出，没有广告的最舒适的小说阅读平台，为您推荐最好看的网络热门小说，找好看的热门的小说，就上就爱小说网。",
    "plugin"        =>  "default",
    "link"          =>  [["github","https://github.com/aknife2019/"],["Aknife's Blog","https://aknife.cn"]]
];

// 开启调试模式
define("DEBUG",false);

// 处理规则
include_once "./vendor/initCore.php";
