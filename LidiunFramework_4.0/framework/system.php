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
	| System 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for controlling the creation and implementation of the sectors
	|
	*/

	class System
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new System();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}
		
		private $Conf = false;
		private $Path = false;
		private $Support = false;
		private $Security = false;
		private $Language = false;
		private $Factory = false;
		private $Database = false;
		private $Playground = false;
		private $Action = false;
		
		public function run(){
			$this->Conf = Conf::Instance();
			$this->Conf->setTimezone();	
			$this->Conf->setSite();	
			$this->Conf->setUrl();			
			$this->Conf->setLocal();			
			$this->Conf->setPreset();			
			$this->Conf->setDisplayError();
			
			$this->Path = Path::Instance();
			$this->Path->setPath();			
			$this->Path->setLink();			
			$this->Path->setFile();			
			$this->Path->setPage();			
			
			$this->Support = Support::Instance();
			$this->Support->setSupport();

			$this->Security = Security::Instance();	
			$this->Security->setBrowse();			
			$this->Security->startSession();			
			$this->Security->setLogged();

			$this->Language = Language::Instance();		
			$this->Language->setLanguage();	

			$this->Factory = Factory::Instance();
			$this->Factory->setParameter();			
			$this->Factory->setActionPath();

			$this->Database = Database::Instance();		
			$this->Database->setConnection();

			$this->Security->setSource();

			$this->Playground = Playground::Instance();		
			$this->Playground->play();
			
			$Action = new $this->Factory->_action;

			$this->Security->getSecurityLevel();
			$this->Factory->mountRequest($this->Factory->_data);
			$this->Language->translation($this->Factory->_data);
			$this->Factory->replaceTag($this->Factory->_data);
			$this->Factory->deliver($this->Factory->_data);
		}

		public function __destruct(){
			$Conf = null;
			$Path = null;
			$Support = null;
			$Security = null;
			$Language = null;
			$Factory = null;
			$Database = null;
			$Playground = null;
			$Action = null;
		}
	}
?>