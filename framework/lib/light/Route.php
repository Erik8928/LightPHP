<?php 
namespace framework\lib\light;

class Route
{
	//控制器
	public $ctrl;
	//控制器方法
	public $action;
	//路径
	public $path;
	//路由
	public $route;

	public $pathLevel = 0;

	public function __construct()
	{
		//加载路由配置文件
		$routeMap = Conf::all('routes');
		// $routeMap =  [
		//     "/"      => \app\controller\Index::class,
		//     "index"  => \app\controller\Index::class,
		//     "indexs" => [
		//         "db" => [
		//             "db" => \app\controller\Index::class,

		// 	        ]
		//     ]
		// ];

		
		if (isset($_SERVER['REQUEST_URI'])) {
			$pathStr = trim($_SERVER['REQUEST_URI'], '/');
			$path = explode('?', $pathStr);
			$path = explode('/',trim($path[0],'/'));

			//获取 controller 
			$ret = $this->catchCtrl($path, $routeMap);

			if ($ret) {
				//通过 array_slice 获取$path 的$this->pathLevel段的值
				$this->path = array_slice($path, $this->pathLevel);
				//通过去去除数组第一个值，剩下的为action
				$this->action  = array_shift($this->path);
			}

 			//如果 action 为空，这默认为 index
			if (is_null($this->action)) {
				$this->action = 'index';
			}	
			
		}
		
	}

    /**
     * 获取控制器
     * @param  [type] $path     $_SERVER[REQUEST_URI']
     * @param  [type] $routeMap 配置文件配置的路由信息
     * @return boolean
     */
	public function catchCtrl($path, $routeMap)
	{
		$this->pathLevel++;  //含有模块下的控制器，如moudle/clildMoudle/controller 时使用
		if(is_array($routeMap)) {
			$index = 0;
			$count = count($path);
			do {
				//如果传入路径数组 为空，则直接返回根目录
				if (! isset($path[$index]) || empty($path[$index])) {
					$path[$index] = '/';
				}

				//如果传入的路径数组的值，属于配置文件数组上的key,且进行递归处理。将最终的值赋予$this->ctrl
				if (array_key_exists($path[$index], $routeMap)) {
					if (is_array($routeMap[$path[$index]])) {
						$routeMap = $routeMap[$path[$index]];
						array_shift($path);

						$this->catchCtrl($path,$routeMap);
						break;
					}
					else{
						$this->ctrl = $routeMap[$path[$index]];
						break;
					}
				}
				$index++;
			} while ($index < $count);
		}
		return $this->ctrl ? true : false;

	}

	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];

	}
		
}