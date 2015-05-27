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
	| Language 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for set language and translation of the system
	|
	*/
	
	class Language
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Language();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		private $Conf = false;
		private $Path = false;
		public $_language = false;

		public function setLanguage() {
			$this->Conf = Conf::Instance();
			$this->Path = Path::Instance();

			if (isset($this->Conf->_url["subdominio"]) && $this->Conf->_url["subdominio"]) {
				$this->_language = $this->Conf->_url["subdominio"];
			} else {
				$this->_language = LANGUAGE_DEFAULT;
			}
		}

		public function translation($content) {
			$text = array();
			
			if (file_exists($this->Path->_path["translation"].$this->_language.".php")) {
				$language = $this->_language;
			} else {
				exit("Config a language to your system like en-us for english or pt-br for portuguese in: Define.php");
			}
			
			require($this->Path->_path["translation"].$language.".php");
			
			foreach ($text as $key => $valor) {
				$content = str_replace('<%'.$key.'%>',$valor,$content);
			}

			return $content;
		}
	}
?>