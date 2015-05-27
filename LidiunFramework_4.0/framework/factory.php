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
	| Factory 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for run the core of the framework, using methods and parameters already seteds by other sectors of the Lidiun
	|
	*/
	
	class Factory
	{		
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Factory();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/
		
		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		private $Conf = false;
		private $Path = false;
		private $Security = false;
		private $Language = false;
		private $Support = false;
		public $_ajax = false;
		public $_action = false;
		public $_parameter = array();
		public $_entity = false;
		public $_data = false;

		public function setParameter() {
			$this->Conf = Conf::Instance();
			$this->Path = Path::Instance();
			$this->Security = Security::Instance();
			$this->Support = Support::Instance();

			if ($this->Conf->_url["uri"]) {
				if (strpos($this->Conf->_url["uri"], "/")) {
					$explode = str_replace("/", " ", $this->Conf->_url["uri"]);
					$uri = explode(" ",$explode);
				} else {
					$uri[0] = $this->Conf->_url["uri"];
				}
				
				if ($uri[0] == "ajax" && isset($_POST["action"])) {
					$this->_ajax = true;
					$this->_action = strtolower($_POST["action"]);
					unset($uri[0]);
					unset($uri["action"]);
					

					if (!file_exists($this->Path->_path["ajax"].$this->_action.".php")) {
						echo json_encode(array("replay" => false));
						exit();
					}
					
					foreach ($_POST as $key => $value) {
						$this->_parameter[$key] = $value;
					}
				} else if (file_exists($this->Path->_path["page"].$uri[0].".php")) {
					$this->_action = $uri[0];
					unset($uri[0]);
				} else {
					$this->_entity = $uri[0];
					unset($uri[0]);
					if (isset($uri[1]) && $uri[1]) {
						$this->_action = $uri[1];
						if (!file_exists($this->Path->_path["page"].$uri[1].".php")) {
							Error::setErrorLog(__FILE__,__CLASS__,__METHOD__,__LINE__,"Low");
							$this->Support->pageNotFound();
						} else {
							unset($uri[1]);
						}
					} else {
						$this->Support->pageNotFound();
					}
				}

				if (count($uri) && (!$this->_ajax)) {
					foreach ($uri as $key => $value) {
						array_push($this->_parameter,addslashes($value));
					}
				}
			} else {
				$this->_action =  ($this->Security->_logged) ? $this->Path->_page["homeIn"] : $this->Path->_page["homeOut"];
			}
		}
		
		public function setActionPath() {
			if ($this->_ajax) {
				ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$this->Path->_path["ajax"]);
			} else {
				ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$this->Path->_path["page"]);
			}
		}

		public function mountRequest($data) {
			$this->Language = Language::Instance();
			if ($this->_ajax) {
				foreach ($data as $key => $value) {
					if ($key != "replay") {
						$data[$key] = $this->Language->translation($value);
					} else {
						$data[$key] = $value;
					}
				}

				$this->_data = $data;
			} else {
				$menu = ($this->Conf->_preset["display_menu"]) ? $this->mountHtml($this->Path->_page["menu"]) : "";
				$footer = ($this->Conf->_preset["display_footer"]) ? $this->mountHtml($this->Path->_page["footer"]) : "";
				$layout = $this->mountHtml($this->Path->_page["layout"]);

				$content = str_replace("<%MENU%>",$menu,$layout);
				$content = str_replace("<%FOOTER%>",$footer,$content);
				$content = str_replace("<%CONTENT%>",$data,$content);

				$content = $this->Language->translation($content);

				$this->_data = $content;
			}
		}

		public function replaceTag($content) {
			$jsAdditional ="";
			$cssAdditional ="";
			if (is_array($GLOBALS["addJs"])) {
				foreach ($GLOBALS["addJs"] as $key => $value) {
					$jsAdditional .= "<script src='".$this->Path->_link["js"].$value.".js' type='text/javascript'></script>";
				}
			}

			if (is_array($GLOBALS["addCss"])) {
				foreach ($GLOBALS["addCss"] as $key => $value) {
					$cssAdditional .= '<link href="'.$this->Path->_link["css"].$value.'.css" rel="stylesheet" type="text/css"/>';
				}
			}

			$site = substr($this->Conf->_url["site"], 0, -1);
			$content = str_replace("<%SITE_TAG%>",$site,$content);
			$content = str_replace("<%SYSTEM_NAME_TAG%>",$this->Conf->_site["name"],$content);
			$content = str_replace("<%COPYRIGHT_TAG%>",$this->Conf->_site["copyright"],$content);
			$content = str_replace("<%TITLE_TAG%>",ucwords($this->_action),$content);
			$content = str_replace("<%AUTHOR_TAG%>",AUTHOR,$content);
			$content = str_replace("<%DESCRIPTION_TAG%>",DESCRIPTION,$content);
			$content = str_replace("<%KEY_WORDS_TAG%>",KEY_WORDS,$content);
			$content = str_replace("<%LANGUAGE_TAG%>",$this->Language->_language,$content);
			
			$content = str_replace("<%CSS_BOOTSTRAP_PATH%>",$this->Path->_file["css_bootstrap"],$content);
			$content = str_replace("<%CSS_BOOTSTRAP_THEME_PATH%>",$this->Path->_file["css_bootstrap_theme"],$content);
			$content = str_replace("<%CSS_MODIFIER_PATH%>",$this->Path->_file["css_bootstrap_modifier"],$content);
			$content = str_replace("<%CSS_SPRITE_PATH%>",$this->Path->_file["css_sprite"],$content);
			$content = str_replace("<%CSS_ADD_PATH%>",$cssAdditional,$content);
			
			$content = str_replace("<%JS_JQUERY_PATH%>",$this->Path->_file["js_jquery"],$content);
			$content = str_replace("<%JS_TOOLS_PATH%>",$this->Path->_file["js_tools"],$content);
			$content = str_replace("<%JS_ADD_PATH%>",$jsAdditional,$content);
			
			$content = str_replace("<%FAVICON_PATH%>",$this->Path->_file["favicon"],$content);
			$content = str_replace("<%JS_PATH%>",$this->Path->_link["js"],$content);
			$content = str_replace("<%CSS_PATH%>",$this->Path->_link["css"],$content);
			$content = str_replace("<%FONT_PATH%>",$this->Path->_link["font"],$content);
			$content = str_replace("<%IMG_PATH%>",$this->Path->_link["img"],$content);
			$content = str_replace("<%BG_PATH%>",$this->Path->_link["bg"],$content);
			$content = str_replace("<%DEFAULT_PATH%>",$this->Path->_link["default"],$content);
			$content = str_replace("<%GIF_PATH%>",$this->Path->_link["gif"],$content);
			$content = str_replace("<%ICON_PATH%>",$this->Path->_link["icon"],$content);		
			$content = str_replace("<%SONG_PATH%>",$this->Path->_link["song"],$content);
			$content = str_replace("<%VIDEO_PATH%>",$this->Path->_link["video"],$content);
			
			
			$content = str_replace("<%BACKGROUND_PATH%>",$this->Conf->_preset["background"],$content);

			$this->_data = $content;
		}

		public function deliver($content) {
			if ($this->_ajax) {
				echo json_encode($content);
			} else {
				header('Content-Type: text/html; charset=UTF-8');
				echo $content;
			}
		}

		public function mountHtml($page) {
			if (file_exists($this->Path->_path["view"].$page.".html")) {
				$handle = fopen($this->Path->_path["view"].$page.".html","r");
				$html = fread($handle,filesize($this->Path->_path["view"].$page.".html"));
				fclose($handle);

				return $html; 
			} else {
				$this->Support->pageNotFound();
			}
		}

		public function addCss($file) {
			array_push($GLOBALS["addCss"],$file);
		}

		public function addJs($file) {
			array_push($GLOBALS["addJs"],$file);
		}
	}
?>