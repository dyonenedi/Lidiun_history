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
	| Path 
	|--------------------------------------------------------------------------
	|
	| This class is responsible to set the given paths, files and system pages
	|
	*/
	
	class Path
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Path();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}
		
		public $_path;
		public $_file;
		public $_page;
		
		public function setPath() {
			$this->_path["public"] = $_SERVER["DOCUMENT_ROOT"]."/";
			$this->_path["aplication"] = $this->_path["public"]."../";
			$this->_path["api"] = $this->_path["aplication"]."api/";
			$this->_path["translation"] = $this->_path["aplication"]."translation/";
			$this->_path["repository"] = $this->_path["aplication"]."repository/";
			$this->_path["ajax"] = $this->_path["repository"]."ajax/";
			$this->_path["page"] = $this->_path["repository"]."page/";
			$this->_path["view"] = $this->_path["repository"]."view/";
			$this->_path["log"] = $this->_path["aplication"]."log/";
			
			$this->_path["download"] = "skin/download/";
			$this->_path["css"] = "skin/css/";
			$this->_path["js"] = "skin/js/";
			$this->_path["img"] = "skin/img/";
			$this->_path["song"] = "skin/song/";
			$this->_path["video"] = "skin/video/";
			$this->_path["font"] = $this->_path["css"]."font/";
			$this->_path["bg"] = $this->_path["img"]."bg/";
			$this->_path["default"] = $this->_path["img"]."default/";
			$this->_path["gif"] = $this->_path["img"]."gif/";
			$this->_path["icon"] = $this->_path["img"]."icon/";
			
		}

		public function setLink() {
			$this->_link["download"] = "/skin/download/";
			$this->_link["css"] = "/skin/css/";
			$this->_link["js"] = "/skin/js/";
			$this->_link["img"] = "/skin/img/";
			$this->_link["song"] = "/skin/song/";
			$this->_link["video"] = "/skin/video/";
			$this->_link["font"] = $this->_path["css"]."font/";
			$this->_link["bg"] = $this->_path["img"]."bg/";
			$this->_link["default"] = $this->_path["img"]."default/";
			$this->_link["gif"] = $this->_path["img"]."gif/";
			$this->_link["icon"] = $this->_path["img"]."icon/";
		}
		
		public function setFile() {
			$this->_file["favicon"] = $this->_path["icon"]."favicon.png";
			
			$this->_file["css_bootstrap"] = $this->_path["css"]."bootstrap.css";
			$this->_file["css_bootstrap_theme"] = $this->_path["css"]."bootstrap_theme.css";
			$this->_file["css_bootstrap_modifier"] = $this->_path["css"]."bootstrap_modifier.css";
			$this->_file["css_sprite"] = $this->_path["css"]."sprite.css";
			
			$this->_file["js_jquery"] = $this->_path["js"]."j_query_1.11.1.js";
			$this->_file["js_tools"] = $this->_path["js"]."tools.js";

			$this->_file["pageNotFound"] = "page/notfound.html";
			$this->_file["pageBrowse"] = "page/browse.html";
			$this->_file["pageSupport"] = "page/support.html";
		}	
		
		public function setPage() {
			$this->_page["layout"] = "layout";
			$this->_page["homeIn"] = PAGE_HOME_LOGGED;
			$this->_page["homeOut"] = PAGE_HOME_UNLOGGED;
			$this->_page["menu"] = "menu";
			$this->_page["footer"] = "footer";
		}	
	}
?>