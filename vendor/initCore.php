<?php
/**
 * 核心文件 定义变量，处理正则等
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2020-03-13 21:49:30
 */

/* 设置时区 */
date_default_timezone_set("Asia/Chongqing");
/* 设置路径常量 - 绝对路径 */
define('__ROOT__',str_replace('\\','/',dirname(__DIR__)).'/');
/* 设置路径常量 - 相对路径 */
define("__WEB__",str_replace("\\","/",dirname($_SERVER["PHP_SELF"])) != "/" ? str_replace("\\","/",dirname($_SERVER["PHP_SELF"]))."/":str_replace("\\","/",dirname($_SERVER["PHP_SELF"])));
define("__URL__",$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].__WEB__);

if( DEBUG === true ) {
    ini_set("display_errors","On");
    error_reporting(E_ALL&~(E_WARNING | E_NOTICE));
}else{
    error_reporting(0);
}

// 处理规则,先判断模板是否存在
$pluginPath = __ROOT__."plugin/".$config["plugin"]."/rule.ak";

if( !is_file($pluginPath) ){
    echo "规则文件不存在";exit;
}
$plugin = json_decode(file_get_contents($pluginPath),ture);

// 判断规则是否指定模版
if( $plugin["theme"] != "" && is_file(__ROOT__."theme/".$plugin["theme"]."/config.ak") ){
    $config["theme"] = $plugin["theme"];
}

// 定义模板路径
define("__TEM__",__ROOT__."theme/".$config["theme"]."/");
define("__CSS__",__WEB__."theme/".$config["theme"]."/css/");
define("__JS__",__WEB__."theme/".$config["theme"]."/js/");
define("__IMG__",__WEB__."theme/".$config["theme"]."/img/");

// phpQuery
include_once __ROOT__."vendor/phpQuery.php";
include_once __ROOT__."vendor/QueryList.php";

// 载入模板引擎
include_once __ROOT__."vendor/viewCore.php";
$View = new viewCore($config);

// 载入函数库
include_once __ROOT__."vendor/funcCore.php";

/**
 * 输出各种类型的数据，调试程序时打印数据使用 print echo 合称。
 * @param   mixed   参数：可以是一个或多个任意变量或值
 */
function PC(){
    $args = func_get_args();  // 获取多个参数
    if( count($args)<1 ){
        echo "<font color='red'>必须为PC()函数提供参数!";
    }   

    echo "<div style='width:100%;text-align:left'><pre>";
    // 多个参数循环输出
    foreach($args as $kry=>$arg){
        if($args[count($args)-1] == $arg && $arg === true){exit;}
        if(is_array($arg)){  
            print_r($arg);
            echo "<br>";
        }else if(is_string($arg)){
            echo $arg."<br>";
        }else{
            var_dump($arg);
            echo "<br>";
        }
    }
    echo "</pre></div>";    
}

/**
 * 获取消息存取(写入文本) File Cache
 * @param string $name 文件名 
 * @param string/array $data 数据内容
 * @param boolean md5是否启用md5,默认为false
 * @param number cache_time 缓存时间
 */
function FC( $name,$data='',$cache_time=0,$md5=true ) {
    if($name){
        // 判断是否设置存储路径；无论右侧是否有/结尾都先清除，再添加
        $filePath = strpos($name,'/') ? dirname($name).'/' : '';
        if( !is_dir(__ROOT__.'data/'.$filePath) ) mkdir(__ROOT__.'data/'.$filePath,0777,true);

        // 判断是否需要md5加密
        $name = '#'.($md5 ? substr(md5($name),8,16) : $name);

        // 获取文件具体路径
        $path = __ROOT__.'data/'.$filePath.$name;

        if($data === ''){    // 读取
            $res = json_decode( @file_get_contents($path) ,true);
            // 判断文件是否过期
            if( $res && ( time() - $res['time'] < $res['cache_time'] || $res['cache_time'] == 0 ) ){
                if( is_array($res['data']) ){
                    $result = $res['data'];
                }else{
                    $result['data'] = $res['data'];
                }
                unset($res['cache_time']);
                return $result ?: $res['data'];
            }else{
                // 文件过期，则删除文件
                @unlink($path);
                return false;
            }
        }elseif(is_null($data)){    // 删除
            @unlink($path);
        }else{  // 生成
            $content['data'] = $data;
            $content['time'] = time();
            $content['cache_time'] = $cache_time;
            @file_put_contents( $path,json_encode($content) );
        }
    }else{
        return false;
    }
}