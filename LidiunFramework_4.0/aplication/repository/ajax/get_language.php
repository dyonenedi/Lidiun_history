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
	| Get Language Ajax 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for return true if language is en-us.
	|
	*/

	class Get_language
	{
		private $Security;
		private $Factory;
		public $ajax = array();	
		
		public function __construct() {
			$this->Security = Security::Instance();
			$this->Security->setSecurityLevel("public");
			$this->Factory = Factory::Instance();
			$this->Language = Language::Instance();

			// Get Language logic

			if ($this->Language->_language == "en-us") {
				$this->ajax["replay"] = true;
			} else {
				$this->ajax["replay"] = false;
			}

			$this->Factory->_data = $this->ajax;
		}
	}
?>