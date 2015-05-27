<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Conf 
	|--------------------------------------------------------------------------
	|
	| This file have the Conf Class. Here somes methods set 
	| properties from system.
	|
	**************************************************************************/
	
	class Conf
	{
		// Variable
		public $_background;
		public $_language;
		public $_localServer;
		public $_logged;
		public $_ajax;
		public $_action;
		public $_parameter = array();
		public $_entity;
		public $_me;
		public $_securityLevel;

		// Array
		public $_url;
		public $_site;
		public $_preset;
		public $_path;
		public $_file;
		public $_page;
		public $_support;
		
		public $_db;
		public $_con;
		
		public function __construct() {
			// Set site properties
			$this->setSite();
			
			// Set urls
			$this->setUrl();
			
			// Set Local
			$this->setLocal();
			
			// Set preset
			$this->setPreset();
			
			// Set display error
			$this->setDisplayError();
			
			// Set paths
			$this->setPath();
			
			// Set files
			$this->setFile();
			
			//  Set pages
			$this->setPage();
			
			// Set pages of the support
			$this->setSupport();
			
			// Set backgrounds
			$this->setBackground(1);
			
			// Set browser allow
			//$this->setBrowser();
			
			// Star session
			$this->startSession();
			 
			// Get logged
			$this->getLogged();

			// Set Language
			$this->setLanguage();
			
			// Set parameters
			$this->setParameter();
			
			// Set action path
			$this->setActionPath();
			
			// Set connection
			$this->setConnection();
		}
		
		public function setSite() {
			$this->_site["name"] = "Lidiun";
			$this->_site["domain"] = "lidiun.com";
			$this->_site["copyright"] = "© ".date("Y")." ".$this->_site["name"];
		}
		
		
		public function setUrl() {
			// Get properties of the url
			$explode =  strtolower($_SERVER ["SERVER_NAME"]);
			$explode = str_replace(".", " ", $explode);
			$explode = trim($explode);
			$explode = explode(" ",$explode);
			
			$domain = explode(".",$this->_site["domain"]);
			if ($explode[0] == strtolower($domain[0])){
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
			
			$this->_url["image"] = "http://image.".$this->_url["domain"]."/";
			$this->_url["image_user"] = $this->_url["image"]."user/";
		}
		
		public function setLocal() {
			if (isset($_SERVER["REMOTE_ADDR"]) && $_SERVER["REMOTE_ADDR"] == "127.0.0.1") {
				$this->_localServer = "local";
			} elseif ($this->_url["domain"] == $this->_site["domain"]) {
				$this->_localServer =  "production";
			} else {
				Error::log("Error trying to get page with domain not exists.",1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
				header("Location: http://www.".$this->_url["domain"]."/page/notfound.html");
			}
		}
		
		public function setPreset() {
			$this->_preset["support"] = false;
			$this->_preset["connect"] = false;
			$this->_preset["debug"] = ($this->_localServer == "local") ? true : false;
			$this->_preset["sessionName"] = "NAME_FOR_YOU_SESSION";
			$this->_preset["sessionCode"] = "4Kkls4Mgb9";
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
		
		public function setPath() {
			$this->_path["root"] = $_SERVER["DOCUMENT_ROOT"]."/../";
			$this->_path["api"] = $this->_path["root"]."api/";
			$this->_path["translation"] = $this->_path["root"]."translation/";
			$this->_path["sector"] = $this->_path["root"]."sector/";
			$this->_path["ajax"] = $this->_path["root"]."repository/ajax/";
			$this->_path["page"] = $this->_path["root"]."repository/page/";
			$this->_path["view"] = $this->_path["root"]."repository/view/";
			$this->_path["log"] = $this->_path["root"]."log/";
			
			$this->_path["public"] = $_SERVER["DOCUMENT_ROOT"]."/";
			$this->_path["pageNotFound"] = "page/notfound.html";
			$this->_path["support"] = "page/support.html";
			
			$this->_path["css"] = "/skin/css/";
			$this->_path["js"] = "/skin/js/";
			$this->_path["bg"] = "/skin/img/bg/";
			$this->_path["icon"] = "/skin/img/icon/";
			$this->_path["song"] = "/skin/song/";
			$this->_path["gif"] = "/skin/img/gif/";
			$this->_path["help"] = "/skin/img/help/";
			$this->_path["default"] = "/skin/img/default/";
		}
		
		public function setFile() {
			$this->_file["favicon"] = $this->_path["icon"]."favicon.png";
			$this->_file["css_default"] = $this->_path["css"]."base.css";
			$this->_file["css_base_default"] = $this->_path["css"]."base-form.css";
			$this->_file["css_sprite_default"] = $this->_path["css"]."base-sprite.css";
			$this->_file["js_default"] = $this->_path["js"]."j_query_1.7.2.js";
			$this->_file["js_helper"] = $this->_path["js"]."helper.js";
		}	
		
		public function setPage() {
			$this->_page["home"] = "home";
			$this->_page["menu"] = "menu";
			$this->_page["footer"] = "footer";
			$this->_page["layout"] = "layout";
		}	
		
		public function setSupport() {
			$this->_support["pageNotFound"] = $this->_url["site"].$this->_path["pageNotFound"];
			$this->_support["support"] = $this->_url["site"].$this->_path["support"];
		}	
		
		public function setBackground($num) {
			$this->_background = $this->_path["bg"]."bg".$num.".jpg";
		}
		
		public function setBrowser() {
			$browser = $_SERVER['HTTP_USER_AGENT'];
			if (preg_match('/MSIE/i', $browser)) {
				$this->supportBrowser();		
			}
		}
		
		public function startSession() {
			if (!isset($_SESSION)) {
				session_name($this->_preset["sessionName"]);
				session_set_cookie_params(0, '/', '.'.$this->_url["domain"]);
				session_start();
			}
		}
		
		public function getLogged() {
			if (isset($_SESSION["ME"]["PERMISSION"]) && $_SESSION["ME"]["PERMISSION"] === $this->_preset["sessionCode"] && isset($_SESSION["ME"]["ACTIVE"]) && $_SESSION["ME"]["ACTIVE"] == 1) {
				$this->_logged = true;
			} else if (isset($_COOKIE["cookUser"]) && isset($_COOKIE["cookPass"]) && isset($_COOKIE["cookCode"]) && $_COOKIE["cookCode"] === $this->_preset["sessionCode"]) {
				$this->_logged = false;
				$this->setConnection();
				$query = " 
					SELECT A.id,A.active FROM user AS A 
					WHERE (A.user = '".$_COOKIE["cookUser"]."' OR A.email = '".$_COOKIE["cookUser"]."') AND A.password = '".$_COOKIE["cookPass"]."'
					LIMIT 1
				";

				$result = $this->_con->query($query);
				if ($result->num_rows) {
					if ($result) {
						$data = $result->fetch_object();
						if ($data->active) {
							$this->setSessionMe($data->id);
							$this->_logged = true;
						}
					}
				}
			} else {
				$this->_logged = false;
			}

			if ($this->_logged) {
				$this->getMe();
			}
		}

		public function setLanguage() {
			if ($this->_logged) {
				$this->_language = $this->_me["language"];
			} else {
				$this->_language = "pt-br";
			}
		}
		
		private function setParameter() {
			if ($this->_url["uri"]) {
				if (strpos($this->_url["uri"], "/")) {
					$explode = str_replace("/", " ", $this->_url["uri"]);
					$uri = explode(" ",$explode);
				} else {
					$uri[0] = $this->_url["uri"];
				}
				
				//$this->validateIp($uri[0]);
				if ($uri[0] == "ajax" && isset($_POST["action"])) {
					$this->_ajax = true;
					$this->_action = strtolower($_POST["action"]);
					unset($uri[0]);
					unset($uri["action"]);
					

					if (!file_exists($this->_path["ajax"].$this->_action.".php")) {
						echo json_encode(array("replay" => false));
						exit();
					}
					
					foreach ($_POST as $key => $value) {
						$this->_parameter[$key] = $value;
					}
				} else if (file_exists($this->_path["page"].$uri[0].".php")) {
					$this->_action = $uri[0];
					unset($uri[0]);
				} else {
					$this->_entity = $uri[0];
					unset($uri[0]);
					if (isset($uri[1]) && $uri[1]) {
						$this->_action = $uri[1];
					} else {
						$this->_action = $this->_page["home"];
					}
				}

				if (count($uri) && (!$this->_ajax)) {
					foreach ($uri as $key => $value) {
						array_push($this->_parameter,addslashes($value));
					}
				}
			} else {
				$this->_action =  ($this->_logged) ? $this->_page["home"] : $this->_page["home"];
			}
		}
		
		private function setActionPath() {
			if ($this->_ajax) {
				ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$this->_path["ajax"]);
			} else {
				ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$this->_path["page"]);
			}
		}
		
		private function setConnection() {
			if ($this->_preset["connect"]) {
				$this->_db = new Database($this->_localServer);
				$this->_con = $this->_db->connect();
				if (!$this->_con) {
					Error::log("Error trying to conect with Database.",1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
					$this->support("Error: Class Conf::setConnection();");
				}
			} else {
				$this->_con = false;
			}
		}
		
		public function getMe() {
			$this->_me["id"] = $_SESSION["ME"]["ID"];
			$this->_me["user"] = $_SESSION["ME"]["USER"];
			$this->_me["active"] = $_SESSION["ME"]["ACTIVE"];
			$this->_me["password"] = $_SESSION["ME"]["PASSWORD"];
			$this->_me["name"] = $_SESSION["ME"]["NAME"];
			$this->_me["email"] = $_SESSION["ME"]["EMAIL"];
			$this->_me["sex"] = $_SESSION["ME"]["SEX"];
			$this->_me["language"] = $_SESSION["ME"]["LANGUAGE"];
			$this->_me["SuHoAdmin"] = $_SESSION["ME"]["WITTLE_ADMIN"];
			$this->_me["permission"] = $_SESSION["ME"]["PERMISSION"];
		}

		public function redirectHome() {
			// redirect to home
			header("Location: ".$this->_url["site"]);
			exit();
		}

		public function pageNotFound() {
			// Page not found
			header("Location: ".$this->_support["pageNotFound"]);
			exit();
		}  
		
		public function support() {
			// Page is in support
			header("Location: ".$this->_support["support"]);
			exit();
		}
		
		public function __destruct() {
			$this->_db = null;
		}
	}
?>