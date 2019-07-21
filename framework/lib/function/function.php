<?php 

/* ++++++++++++++++++++++++++++++++++++++++
 * 全局函数
 *+++++++++++++++++++++++++++++++++++++++++ */

function show404()
{
	header('HTTP/1.1 404 Not Found');
	header("status: 404 Not Found");
	include '404.html';
	exit();
}