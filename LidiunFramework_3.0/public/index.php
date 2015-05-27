<?php
	/**********************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 26/08/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	**********************************************************/
	
	/*
	|--------------------------------------------------------------------------
	| Index 
	|--------------------------------------------------------------------------
	|
	| This file have require autoload and System Class that run the system.
	|
	*/

	// Define timezone from Brazil
	date_default_timezone_set('America/Sao_Paulo');
	
	// Include autoload
	if (file_exists($_SERVER["DOCUMENT_ROOT"]."/../sector/autoload.php")) {
		require_once($_SERVER["DOCUMENT_ROOT"]."/../sector/autoload.php");
	} else {
		header("Location: http://".$_SERVER["SERVER_NAME"]."/page/support.html?id=0");
		exit();
	}
	
	// Js and Css additional (Global variable)
	$addJs = array();
	$addCss = array();
	
	// Class System run aplication
	class System
	{
		protected $core;
		protected $app;

		public function __construct() {
			// Construct the core of system
			$this->core = Core::Instance();
			
			// Load class of the action
			$this->app = new $this->core->_action();
			
			// Send request to user
			$this->core->done($this->app->_data);
		}
		
		public function __destruct() {
			$this->core = null;
			$this->app = null;
		}
	}
	
	// Start system in the constructor
	$system = new System();
	$system = null;
?>
