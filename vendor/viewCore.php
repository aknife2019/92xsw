<?php
/**
 * 核心文件 模板类
 * @Website: https://aknife.cn
 * @Author: Aknife(code@aknife.cn)
 * @Last Modified time: 2019-07-22 03:05:01
 */
class viewCore
{
    private static $config;
    private static $viewData;
    private static $tp;

    /**
     * 架构函数
     * @access public
     * @param array $config
     */
    public function __construct($config){
        // 则载入tp
        include __ROOT__.'vendor/thinkphp/Template.php';
        // 设置模板引擎参数
        $tpConfig = [
            'view_path'     =>  __TEM__,
            'cache_path'    =>  __ROOT__.'data/html/',
            'view_suffix'   =>  'php'
        ];

        $thinkphp = new Template($tpConfig);
        self::$tp = $thinkphp;
        
        self::$config = $config;
    }

    public static function assign($name,$value){
        $config = self::$config;
        self::$viewData[$name] = $value;
        self::$tp->assign('config',$config);
        self::$tp->assign($name,$value);
    }

    public static function display($path=''){
        // path未指定时，自动根据前台模板获取
        if( $path == '' ){
            // 获取当前执行的脚本
            $path = str_replace(__WEB__,'',$_SERVER['PHP_SELF']);
            $path = __TEM__.$path;
        }

        self::$tp->fetch($path);
        self::$tp->display( $content );
        exit;
    }
}
