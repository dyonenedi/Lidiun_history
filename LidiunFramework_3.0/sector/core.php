<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Core 
	|--------------------------------------------------------------------------
	|
	| This file have the Core Class. Here some methods using 
	| properties from Conf Class, get all information needed to system run.
	|
	**************************************************************************/
	
	class Core extends  Conf
	{		
		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Core();
			}
			return self::$_instance;
		}
		
		public function __construct() {
			parent::__construct();
		}

		/*
		|--------------------------------------------------------------------------
		| Methods from system 
		|--------------------------------------------------------------------------
		|
		| This methods be used for Action Class and somes 
		| parts off Core.
		|
		*/

		public function done($data) {
			if ($this->_ajax) {
				foreach ($data as $key => $value) {
					if ($key != "replay") {
						$data[$key] = $this->translation($value);
					} else {
						$data[$key] = $value;
					}
				}
				echo json_encode($data);
			} else {
				$content =  $this->mountRequest($data);
				header('Content-Type: text/html; charset=UTF-8');
				echo $content;
			}
		}

		public function setSecurityLevel(){
			if(isset($this->_securityLevel)){
				if ($this->_securityLevel == "mustBeLogged") {
					if ($this->_logged == false) {
						Error::log("Error trying to get action ".$this->_action." not allow for: ".$this->_securityLevel,1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
						$this->redirectHome();
					} else {
						return true;
					}
				} elseif($this->_securityLevel == "mustBeNotLogged") {
					if ($this->_logged == true) {
						Error::log("Error trying to get action ".$this->_action." not allow for: ".$this->_securityLevel,1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
						$this->redirectHome();
					} else {
						return true;
					}
				} elseif($this->_securityLevel == "whatever"){
					return true;
				} else {
					Error::log("Error trying to get action ".$this->_action." not allow for: ".$this->_securityLevel,1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
					$this->redirectHome();
				}
			} else {
				Error::log("Error trying to get action ".$this->_action." not allow for: ".$this->_securityLevel,1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
				$this->redirectHome();
			}
		}
		
		public function mountRequest($html) {
			// Mount menu
			$menu = $this->mountHtml($this->_page["menu"]);
			
			// Mount footer
			$footer = $this->mountHtml($this->_page["footer"]);
			
			$layout = $this->mountHtml($this->_page["layout"]);
			
			$key = $this->generatesKey();

			$content = str_replace("<%MENU%>",$menu,$layout);
			$content = str_replace("<%FOOTER%>",$footer,$content);
			$content = str_replace("<%CONTENT%>",$html ,$content);
			$content = str_replace("<%KEY%>",$key,$content);
			$content =  $this->translation($content);
			$content = $this->replaceTag($content);
			
			return $content;
		}
		
		public function translation($content) {
			$idiomas = array();
			if (file_exists($this->_path["translation"].$this->_language.".php")) {
				$language = $this->_language;
			} else {
				$language = "pt-br";
			}
			require($this->_path["translation"].$language.".php");
			foreach ($idiomas as $key => $valor) {
				$content = str_replace('<%'.$key.'%>',$valor,$content);
			}

			return $content;
		}
		
		public function replaceTag($content) {
			$jsAdditional ="";
			$cssAdditional ="";
			
			if (is_array($GLOBALS["addJs"])) {
				foreach ($GLOBALS["addJs"] as $key => $value) {
					$jsAdditional .= "<script src='".$this->_path["js"].$value.".js' type='text/javascript'></script>";
				}
			}

			if (is_array($GLOBALS["addCss"])) {
				foreach ($GLOBALS["addCss"] as $key => $value) {
					$cssAdditional .= '<link href="'.$this->_path["css"].$value.'.css" rel="stylesheet" type="text/css" />';
				}
			}

			$content = str_replace("<%FAVICON_TAG%>",$this->_file["favicon"],$content);
			$content = str_replace("<%CSS_DEFAULT_TAG%>",$this->_file["css_default"],$content);
			$content = str_replace("<%CSS_DEFAULT_FORM_TAG%>",$this->_file["css_base_default"],$content);
			$content = str_replace("<%CSS_DEFAULT_SPRITE_TAG%>",$this->_file["css_sprite_default"],$content);
			$content = str_replace("<%CSS_ADD_TAG%>",$cssAdditional,$content);
			$content = str_replace("<%JS_DEFAULT_TAG%>",$this->_file["js_default"],$content);
			$content = str_replace("<%JS_HELPER_TAG%>",$this->_file["js_helper"],$content);
			$content = str_replace("<%JS_ADD_TAG%>",$jsAdditional,$content);
			$content = str_replace("<%SONG_TAG%>",$this->_path["song"],$content);
			$content = str_replace("<%ICON_TAG%>",$this->_path["icon"],$content);
			$content = str_replace("<%DEFAULT_TAG%>",$this->_path["default"],$content);
			$content = str_replace("<%GIF_TAG%>",$this->_path["gif"],$content);
			$content = str_replace("<%BG_TAG%>",$this->_path["bg"],$content);
			$content = str_replace("<%HELP_TAG%>",$this->_path["help"],$content);
			$content = str_replace("<%JS_TAG%>",$this->_path["js"],$content);
			$content = str_replace("<%SYSTEM_NAME_TAG%>",$this->_site["name"],$content);
			$content = str_replace("<%COPYRIGHT_TAG%>",$this->_site["copyright"],$content);
			$content = str_replace("<%BACKGROUND_TAG%>",$this->_background,$content);
			$content = str_replace("<%TITLE%>",ucwords($this->_action),$content);

			return $content;
		}
		
		public function mountHtml($page) {
			// Mount some html passed like parameter 
			if (file_exists($this->_path["view"].$page.".html")) {
				$handle = fopen($this->_path["view"].$page.".html","r");
				$html = fread($handle,filesize($this->_path["view"].$page.".html"));
				fclose($handle);

				return $html; 
			} else {
				Error::log("Error trying to get ".$page.".html",1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
				$this->pageNotFound();
			}
		}

		public function setSessionMe($id) {
			$result = $this->selectDataMe($id);

			if ($result) {
				// Set Session me just when login
				$data = $result->fetch_object();
				$_SESSION["ME"]["ID"] = $data->id;
				$_SESSION["ME"]["USER"] = $data->user;
				$_SESSION["ME"]["ACTIVE"] = $data->active;
				$_SESSION["ME"]["PASSWORD"] = $data->password;
				$_SESSION["ME"]["NAME"] = $data->name;
				$_SESSION["ME"]["EMAIL"] = $data->email;
				$_SESSION["ME"]["SEX"] = $data->sex;
				$_SESSION["ME"]["LANGUAGE"] = $data->language;
				$_SESSION["ME"]["PERMISSION"] = $this->_preset["sessionCode"];
			} else {
				$_SESSION = array();
				Error::log("Error trying to mount session me with id: ".$id." ",1,4,__FILE__,__CLASS__,__METHOD__,__LINE__);
				$this->support();
			}
		}

		private function selectDataMe($id) {
			$query = " 
				SELECT A.id,A.user,A.name,A.active,A.password,A.email,A.sex,A.language,B.id AS admin FROM user AS A
				LEFT JOIN admin AS B ON(A.id = B.id_user)
				WHERE A.id = ".$id."
				LIMIT 1
			";

			$result = $this->_con->query($query);
			if ($result->num_rows) {
				return $result;
			} else {
				return false;
			}
		}

		// Generate Hash to use in posts, logins or messages
		protected function generatesKey() {
			if(!isset($_SESSION["SITE"]["KEY_FORM"]) && !isset($_SESSION["SITE"]["KEY_TIME"])) {
				$generate = true;
			} else {
				$hour = $_SESSION["SITE"]["KEY_TIME"];
				if (($hour + 4) < date("H")) {
					$generate = true;
				} else {
					$generate = false;
				}
			}
			
			if ($generate) {
				$_SESSION["SITE"]["KEY_TIME"] = date("H");
				$_SESSION["SITE"]["KEY_FORM"] = null;
				$keyList = array("SaR43akf2uufhc8","niofjD8Vsdfm3ttsd","49dkkakt023mD034","2Dccfg55GG83C2d");
				$key = $keyList[rand(0,3)];
				$number1 = rand(100,999);
				$number2 = rand(100,999);
				$number = $number1 * $number2 / 111;
				$date = date("Ymd");
				$time = date("His");
				$key = $date.$key.$time;
				$key = $number.$key;
				
				$number1 = rand(100,999);
				$number2 = rand(100,999);
				$number = $number1 * $number2 / 111;
				
				$key = sha1($key.$number);
				$key = $date.$time.$key;
				$key = substr($key, 0, 34);
				$_SESSION["SITE"]["KEY_FORM"] = $key;
			} else {
				$key = $_SESSION["SITE"]["KEY_FORM"];
			}
			
			return $key;
		}

		public function getIdByUser($user) {
			$user = addslashes(trim(strtolower($user)));
			$query = "
				SELECT A.id, A.active FROM user AS A 
				WHERE A.user = '".$user."'
			";

			$result = $this->_con->query($query);
			
			if ($result->num_rows) {
				return $result;
			} else {
				return false;
			}
		}

		public function logout() {
			$_SESSION = array();
			setcookie("cookUser", "", time()-(60*60*24*100), "/"); 
			setcookie("cookPass", "", time()-(60*60*24*100), "/"); 
			setcookie("cookCode", "", time()-(60*60*24*100), "/"); 
			header("Location: ".$this->_url["site"]);
			exit();
		}
		
		public function __destruct() {
			parent::__destruct();
		}
	}
?>