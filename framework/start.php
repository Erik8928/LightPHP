<?php 

use framework\lib\light\App as AppPHP;

//载入框架运行文件
define('LIGHTPHP_PATH', realpath('./') ); //项目执行当前目录
define('LIGHTPHP', realpath('./../'));  //根目录
//通过变量动态设置 module 的名字
$MODULE_NAME = 'app';
define('MODULE', $MODULE_NAME);
define('APP', LIGHTPHP.'/'. MODULE .'/'); //模块目录
define('FRAMEWORK', LIGHTPHP . '/framework/'); //核心文件目录

define("DEBUG", getenv('APP_DEBUG'));

include FRAMEWORK . 'lib/function/function.php';
include FRAMEWORK . 'lib/light/Loader.php';

spl_autoload_register('\Loader::load');

 //运行框架
 AppPHP::run();


