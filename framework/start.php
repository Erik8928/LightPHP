<?php 

use framework\lib\light\App as AppPHP;

//载入框架运行文件
define('LIGHTPHP_PATH', realpath('./') );
// define('LIB',LIGHTPHP_PATH.'../framework/lib');
// define('LIGHT', LIB.'/light');

 include __DIR__. "/lib/light/Loader.php";

 spl_autoload_register('\Loader::load');

 //运行框架
 AppPHP::run();


