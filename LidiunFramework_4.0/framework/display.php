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
	| Display 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for showing in detail an object or array
	|
	*/
	
	class Display
	{
		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		public static function show($obj=array("System")) {
			header('Content-Type: text/html; charset=UTF-8');
			echo "<pre style='font-family: monospace;'>";
			print_r($obj);
			echo "</pre>";
			exit;
		}
	}
?>