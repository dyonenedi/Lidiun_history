<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Autoload 
	|--------------------------------------------------------------------------
	|
	| This file have the paths to auto load.
	|
	**************************************************************************/
	
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../sector");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/email");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/image");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/ipdetails");
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR."../api/facebook");

	function __autoload($class) {
		$class  = strtolower($class).".php";
		if (!include_once($class)) {
		   	header("Location: http://".$_SERVER["SERVER_NAME"]."/page/support.html?id=1");
			exit();
		}
	}
?>
