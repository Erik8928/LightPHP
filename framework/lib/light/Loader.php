<?php 


class Loader
{
	/**
	 * 类名映射
	 * @var array
	 */
	protected static $classMap = [];

	/**
	 * 自动加载类
	 * @param  object $class 
	 * @return boolean 
	 */
	static public function load($class)
	{
		if (isset($classMap)) {

			return true;	
		} else {	
			$class = str_replace('\\', '/', $class);
			self::$classMap = $class;
			var_dump($class);
			$file = LIGHTPHP_PATH.'/../'.$class.'.php';	

			if (is_file($file)) {
				include $file;
			} else {
				return false;
			}
		}	

	}
}