<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Home Class 
	|--------------------------------------------------------------------------
	|
	| This class will provide the login page for the user.
	|
	**************************************************************************/
	
	class Home extends Tools
	{
		private $core;
		public $_data;
		
		public function __construct() {
			// Instance the Class Core and set security level
			$this->core = Core::Instance();
			$this->core->_securityLevel = "mustBeNotLogged";
			$this->core->setSecurityLevel();

			// Additional Javascript
			array_push($GLOBALS["addJs"],"home");
			
			
			// Home logic
			$this->_data = $this->core->mountHtml($this->core->_action);
		}
	}
?>	