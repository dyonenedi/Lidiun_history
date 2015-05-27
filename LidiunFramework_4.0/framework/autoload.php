<?php
	/**********************************************************
	* Lidiun 4.0 - A PHP Framework
	*
	* @Created 26/08/2013
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @Modify 20/05/2014
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	*
	**********************************************************/
	
	/*
	|--------------------------------------------------------------------------
	| Autoload 
	|--------------------------------------------------------------------------
	|
	| This file has the responsibility to include the paths of classes to instantiate them without include
	|
	*/

	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../config");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../playground");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/tools");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/email");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/image");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/ipdetails");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/facebook");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../../framework");

	function __autoload($class) {
		$class  = strtolower($class).".php";
		if (!include_once($class)) {
		   	header("Location: http://".$_SERVER["SERVER_NAME"]."/page/support.html?message=autoload_error");
			exit();
		}
	}
?>
