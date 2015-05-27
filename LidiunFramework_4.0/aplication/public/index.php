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
	| Index 
	|--------------------------------------------------------------------------
	|
	| This file is responsible for starting the Lidiun framework by instantiating the class system
	|
	*/
	
	// Include autoload
	if (file_exists($_SERVER["DOCUMENT_ROOT"]."/../../framework/autoload.php")) {
		require_once($_SERVER["DOCUMENT_ROOT"]."/../../framework/autoload.php");
	} else {
		header("Location: http://".$_SERVER["SERVER_NAME"]."/page/support.html?message=autoload_not_find");
		exit();
	}
	
	// Js and Css additional (Global variable)
	$addJs = array();
	$addCss = array();
	
	// Include define and system class
	require_once($_SERVER["DOCUMENT_ROOT"]."/../config/define.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/../../framework/system.php");
	
	$System = System::Instance();
	$System->run();
	$System = null;
?>
