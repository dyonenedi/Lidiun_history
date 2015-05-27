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
	| Download Page 
	|--------------------------------------------------------------------------
	|
	| This class is responsible to download Lidiun Framework
	|
	*/
	
	class Download
	{
		private $Security;
		private $Factory;
		private $Path;
		
		public function __construct() {
			$this->Security = Security::Instance();
			// Set Security Level of this action
			$this->Security->setSecurityLevel("public");

			$this->Path = Path::Instance();
			$this->Factory = Factory::Instance();
			// Add additional Css and Javascript
			$this->Factory->addCss("home");
			$this->Factory->addJs("home");
			
			// Download logic
			// Download logic
			$this->Tools = new Tools;
			
			$fileName = "Lidiun 4.0.rar";
			$file = $this->Path->_path["public"].$this->Path->_path["download"].$fileName;

			$this->Tools->download($file,$fileName);

			$this->Factory->_data = "";
		}
	}
?>	