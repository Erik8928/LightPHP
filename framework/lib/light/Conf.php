<?php 
namespace framework\lib\light;

class Conf 
{
	static public $conf = [];

    /**
     * 加载配置文件的某个字段的配置信息，如果原来加载直接返回
     * @param  string $file [文件名]
     * @param  [type] $name [某个配置端的 key name]
     * @return string || array
     */
	static public function get($file = 'conf', $name)
	{
		$conf = LIGHTPHP . '/config/' . $file . '.php';
		if (is_file($conf)) {
			self::$conf[$file] = include $conf;
			var_dump(self::$conf[$file][$name]);
			return isset(self::$conf[$file][$name]) ? self::$conf[$file][$name] : false;
		}
		else {
			throw new \Exception('没有' . $name .'配置信息' );
		}
	}

	/**
	 * 加载配置文件，如果之前加载过，则直接返回，没有则要新加载
	 * @param  string $file [文件名]
	 * @return string
	 */
	static public function all($file)
	{
		if (isset(self::$conf[$file])) {
			return self::$conf[$file];
		}
		else {	
			$conf =  LIGHTPHP .'/config/' . $file . '.php';
			if (is_file($conf)) {
				self::$conf[$file] = include $conf;
				return self::$conf[$file];
			}
			else {
				throw new \Exception("配置文件不存在");	
			}
		}

	}
}