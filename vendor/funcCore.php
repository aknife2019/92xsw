<?php
/**
 * 全局函数
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2020-03-13 21:49:23
 */
use QL\QueryList;

// 解析导航菜单
function baseMenu(){
    global $plugin;

    $menu = [];
    foreach( $plugin['menu'] as $key=>$val ){
        if( is_array($val) ){
            $val = array_values($val);
            $menu[$key] = $val[0];
        }else{
            $menu[$key] = $val;
        }
    }
    return $menu;
}

/** 
 * ranking 规则解析方案 
 * @param $rule array 规则列表
 * @param $cacheName string 缓存文件名称
 */
function regexMatch($rule,$cacheName=''){
    // 引入规则数组
    global $plugin;

    $url = $plugin['url'].$rule['url'];

    // 判断是否开启缓存
    if( $rule['cache'] && !empty($cacheName) ){
        $result = FC($cacheName);
        if( $result ){
            return $result;
        }
    }
    $url = $plugin['url'].$rule['url'];
    $range = $rule['range'];
    $regex = $rule['regex'];

    // 判断是否例外
    if( $rule['exception'] ){
        $exception = explode(',',$rule['exception']);
        foreach( $exception as $val ){
            if( strpos($url,$val) !== false ){
                $regex = $rule[$val];
                break;
            }
        }
    }
    // 获取当前规则结果
    foreach( $regex as $key=>$val ){
        // 判断规则文件是否指定取什么类型
        if( strpos($val,'@') ){
            $ruleType = explode('@',$val);
            $rules[$key] = [$ruleType[0],$ruleType[1]];
        }else{
            $rules[$key] = [$val,'text'];
        }
    }

    // 判断转码
    if( $plugin['charset'] == 'gbk' ){
        $result = QueryList::Query($url,$rules,$range,'utf-8','gbk',true)->data;
    }else{
        $result = QueryList::Query($url,$rules,$range)->data;
    }
    phpQuery::$documents = array();

    // 判断是否有排除规则
    if( $rule['exclude'] ){
        $exclude = explode("|",$rule['exclude']);
        foreach( $exclude as $val ){
            unset($result[$val]);
        }
    }

    // 删除空数组
    $result = array_filter(array_map('array_filter',$result));

    // 如果指定了limit，则判断是否大于limit的值，如果大于则截断
    if( isset($rule['limit']) && $rule['limit'] > 0 && count($result) > $rule['limit'] ){
        $result = array_slice($result,0,$rule['limit']);
    }
    $result = array_values($result);
    
    // 判断是否有字符串拼接
    if( isset($rule['link']) ){
        $link = explode('@',$rule['link']);
        $result[0][$link[0]] = $result[0][$link[1]].str_replace($result[0][$link[1]],'',$result[0][$link[0]]);
    }

    // 写入缓存
    if( $rule['cache'] && !empty($cacheName) ){
        FC($cacheName,$result,$rule['cache']*60);
    }

    return $result;
}

// 解析域名 把原域名转换为本地url
// url 要替换的url
// type 要替换的url类型
// replace 是否要替换字符串
// string 是否要拼接字符串
function baseUrl($url,$type,$replace=0,$string=""){
    global $plugin;
    global $config;
    $url = $string.str_replace($plugin['url'],'',$url);
    $preg= $plugin['replace']['regex'][$type];

    // 解析规则
    if( $preg ){
        $url = preg_replace("/{$preg[0]}/",$preg[1],$url);
    }

    // 判断是否需要url的字符串替换
    if( $replace ){
        // url替换
        foreach( $plugin['replace']['url'] as $key=>$val ){
            $url = str_replace($key,$val,$url);
        }
    }

    return $config['website'].ltrim($url,'/');
}

// 解密url，对应源站数据
function decodeUrl($url){
    global $plugin;
    if( $plugin['replace']['deurl'] ){
       foreach( $plugin['replace']['deurl'] as $key=>$val ){
            $url = str_replace($key,$val,$url);
        }
    }

    return $url; 
}

// 字符串替换
function strReplace($str){
    global $plugin;
    if( $plugin['replace']['text'] ){
        foreach( $plugin['replace']['text'] as $key=>$val ){
            $str = str_replace($key,$val,$str);
        }
    }
        
    return $str;
}

// 获取分类seo资料
function getCategorySeo($url,$array){
    // 先替换翻页
    $url = preg_replace('/\d+\.html/','',$url);
    // 替换排行榜top字符
    $url = str_replace('top','',$url);
    
    foreach( $array as $key=>$val ){
        if( strpos($val,$url) !== false ){
            $title = $key;
            break;
        }
    }
    return $title;
}

// 章节内容简介，要替换部分内容、去除html代码
function getContentDesc($string,$limit=200){
    // 先转义html实体编码
    $string = html_entity_decode($string);

    // 去除html标签
    $string = strip_tags($string);

    // 去除空格，并替换特殊字符
    $string = str_replace(["\r\n","\r","\n","\t"," "],"",$string);
    // 去除&nbsp;空格，先unicode编码，最方便的就是json了，替换后转回
    $string = json_decode(str_replace("\u00a0","",json_encode($string)));
    return mb_substr($string,0,$limit);
}