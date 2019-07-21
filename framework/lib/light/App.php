<?php 
namespace framework\lib\light;

use framework\lib\light\exception\ClassNotFoundException;
use framework\lib\light\Route;


class App
{
	static public $config;
	/**
	 * 加载控制器，和执行控制器当前的方法
	 * @return 
	 */
	public function run()
	{
		//自动加载配置文件
		// self::$config = new Conf(); 

		//加载 route 解析URL
		$request = new Route();

		if (is_null($request->ctrl)) {
			show404();	
		}

		//获取控制器，并加载控制器
		$ctrlClass = $request->ctrl;
		$action = $request->action;
		try {
			$ctrl = new $ctrlClass();	
		} catch (\Exception $e) {
			if (DEBUG) {
				throw new ClassNotFoundException($ctrlClass . '控制器不存在');
			} else {
				show404();
			}
			return false;
		}
		
		// $action = strtolower($request->method()) . ucfirst($action);
		//判断控制器类中的方法是否存在
	    if (method_exists($ctrl, $action)) {
	    	//如果存在方法通过回调 执行当前方法
	    	call_user_func([$ctrl, $action]);

	    } else {
	    	if (DEBUG) {
                throw new ppphpException($action . '是一个不存在的方法');
            }
            else {
                show404();
            }
			
		}
    }
}