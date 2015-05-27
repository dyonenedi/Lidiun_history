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
	| Home Page 
	|--------------------------------------------------------------------------
	|
	| This class is responsible to display home page
	|
	*/
	
	class Home
	{
		private $Security;
		private $Factory;
		
		public function __construct() {
			$this->Security = Security::Instance();
			// Set Security Level of this action
			$this->Security->setSecurityLevel("public");

			$this->Factory = Factory::Instance();
			// Add additional Css and Javascript
			$this->Factory->addCss("home");
			$this->Factory->addJs("home");
			
			// Home logic
			$content = $this->Factory->mountHtml($this->Factory->_action);
			$this->Factory->_data = $content;
		}
	}
?>	