<?php 

namespace framework\lib\light\exception;

use framework\lib\Exception;

class ClassNotFoundException extends \RuntimeException
{
	protected $class;

	public function __construct($message, $class = '')
	{
		$this->message = $message;
		$this->class = $class;
	}

	/**
	 * 获取类名
	 */

	public function getClass()
	{
		return $this->class;
	}

}