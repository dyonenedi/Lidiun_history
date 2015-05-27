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
	| Conf 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for creating and setting system variables, some developer-defined in "define.php" file
	|
	*/
	
	class Conf
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Conf();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		public $_localServer;
		public $_site;
		public $_url;
		public $_preset;
		
		
		public function setTimezone() {
			date_default_timezone_set(TIMEZONE);
		}

		public function setSite() {
			$this->_site["name"] = NAME;
			$this->_site["domain"] = DOMAIN;
			$this->_site["copyright"] = COPYRIGHT;
			$this->_site["statement"] = STATEMENT;
			$this->_site["production"] = PRODUTION;
		}
		
		
		public function setUrl() {
			// Get properties of the url
			$explode =  strtolower($_SERVER ["SERVER_NAME"]);
			$explode = str_replace(".", " ", $explode);
			$explode = trim($explode);
			$explode = explode(" ",$explode);
			
			if ($explode[0] == strtolower($this->_site["name"])){
				header("Location: http://www.".$this->_site["domain"]);
				exit();
			}
			
			$this->_url["subdomain"] = $explode[0];
			$this->_url["domain"] = (isset($explode[3])) ? $explode[1].".".$explode[2].'.'.$explode[3] : $explode[1].".".$explode[2] ;
			$this->_url["site"] = "http://".$this->_url["subdomain"].".".$this->_url["domain"]."/";

			$url = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : false;
			
			if ($url && $url != "" && $url != "/") {
				$url = str_replace("/", " ", $url);
				$url = trim($url);
				$url = str_replace(" ","/",$url);
				$this->_url["uri"] = $url;
				$this->_url["fullUrl"] = $this->_url["site"].$url."/";
			} else {
				$this->_url["uri"] = false;
				$this->_url["fullUrl"] = $this->_url["site"];
			}
		}
		
		public function setLocal() {
			if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
				$this->_localServer = "local";
			} elseif ($this->_url["domain"] == $this->_site["production"]) {
				$this->_localServer = "production";
			} elseif ($this->_url["domain"] == $this->_site["statement"]) {
				$this->_localServer = "statement";
			} else {
				header("Location: ".$this->Conf->_url["site"]."page/notfound.php");
				exit();
			}
		}
		
		public function setPreset() {
			$this->_preset["support"] = SUPPORT;
			$this->_preset["connect"] = CONECT_DB;
			$this->_preset["debug"] = ($this->_localServer == "local" || $this->_localServer == "statement") ? true : false;
			$this->_preset["sessionName"] = $this->_site["name"];
			$this->_preset["sessionCode"] = SESSION_CODE;
			$this->_preset["securityLevel"] = SECURITY_LEVEL;
			$this->_preset["background"] = (BACKGROUND) ? "background: url(/skin/img/bg/".BACKGROUND.");" : "";
			$this->_preset["display_menu"] = DISPLAY_MENU;
			$this->_preset["display_footer"] = DISPLAY_FOOTER;
		}

		public function setDisplayError() {
			if ($this->_preset["debug"]) {
				ini_set("display_errors", 1);
				ini_set("log_errors", 0);
				ini_set("error_reporting", E_ALL);
			} else {
				ini_set("display_errors", 0);
				ini_set("log_errors", 1);
				ini_set("error_reporting", 0);
			}
		}	
	}
?>