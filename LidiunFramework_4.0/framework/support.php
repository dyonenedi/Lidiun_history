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
	| Support 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for the support redirects of the framework
	|
	*/
	
	class Support
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Support();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}
		
		private $Conf;
		private $Path;
		public $_support;
		
		public function setSupport() {
			$this->Conf = Conf::Instance();	
			$this->Path = Path::Instance();
			$this->_support["pageNotFound"] = $this->Conf->_url["site"].$this->Path->_file["pageNotFound"];
			$this->_support["pageBrowse"] = $this->Conf->_url["site"].$this->Path->_file["pageBrowse"];
			$this->_support["pageSupport"] = $this->Conf->_url["site"].$this->Path->_file["pageSupport"];
		}

		public function redirectHome() {
			header("Location: ".$this->Conf->_url["site"]);
			exit();
		}

		public function pageNotFound() {
			header("Location: ".$this->_support["pageNotFound"]);
			exit();
		}
		
		public function pageBrowse() {
			header("Location: ".$this->_support["pageBrowse"]);
			exit();
		}

		public function pageSupport() {
			header("Location: ".$this->_support["pageSupport"]);
			exit();
		}
	}
?>