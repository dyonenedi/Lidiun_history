<?php
	### Create object that will help whit very tools (Methods)
	class Helper
	{			
		protected function setConfig()
		{
			if (file_exists("conf/settings.php")) {
				require_once("conf/settings.php");
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function getDomain()
		{
			$this->_exUrl = explode('.',$_SERVER["HTTP_HOST"]);
			$this->_subdomain = $this->_exUrl[0];
			$this->_domain = $this->_exUrl[1];
			$this->_extDominio = isset($this->_exUrl[3]) ? $this->_exUrl[2].'.'.$this->_exUrl[3] : $this->_exUrl[2] ;
			$this->_uri = $this->_subdomain.".".$this->_domain.".".$this->_extDominio;
			$this->_url = $this->_uri.$_SERVER["REQUEST_URI"];
			$this->_lang = (isset($this->_subdomain)  && $this->_subdomain != "www") ? strtolower($this->_subdomain) : "en-us" ;
		}
		
		protected function getParameter()
		{
			$this->_parameter = explode("/",$_SERVER ["REQUEST_URI"]);
			unset($this->_parameter[0]);
			
			if (isset($this->_parameter[1]) && $this->_parameter[1] != "") {
				$this->_page = $this->_parameter[1];
			} else {
				$this->_page = $this->_pageDefault;
			}
			unset($this->_parameter[1]);
			
			for ($i = 0; $i < count($this->_parameter); $i++) {
				$this->_parameter[$i] = $this->_parameter[$i+2];
			}
		}
		
		protected function validateSession($page=false)
		{
			if (isset($this->_userPermission) && $this->_userPermission === $this->_secureCode) {
				return true;
			} else {
				return false;
			}
		}
		
		protected function mountController()
		{
			if (file_exists($this->_controller.$this->_page.$this->_controlerPHP)) {
				require_once($this->_controller.$this->_page.$this->_controlerPHP);
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function mountMenu()
		{
			if (file_exists($this->_view.$this->_menu.".html")) {
				$handle = fopen($this->_view.$this->_menu.".html","r");
				$content = fread($handle,filesize($this->_view.$this->_menu.".html"));
				fclose($handle);
				$content = str_replace("<%LAYOUT_TAG%>",$this->_layoutPath,$content);
				
				$this->_menuContent = $content;
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function mountFooter()
		{
			if (file_exists($this->_view.$this->_footer.".html")) {
				$handle = fopen($this->_view.$this->_footer.".html","r");
				$content = fread($handle,filesize($this->_view.$this->_footer.".html"));
				fclose($handle);
				$content = str_replace("<%COPYRIGHT_TAG%>",$this->_copyright,$content);
				
				$this->_footerContent = $content;
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function mountLayout()
		{
			if (file_exists($this->_view.$this->_layout.".html")) {
				$handle = fopen($this->_view.$this->_layout.".html","r");
				$content = fread($handle,filesize($this->_view.$this->_layout.".html"));
				fclose($handle);
				$content = str_replace("<%FAVICON_TAG%>",$this->_path_favicon,$content);
				$content = str_replace("<%SYSTEM_NAME_TAG%>",$this->_systemName,$content);
				$content = str_replace("<%CSS_DEFAULT_TAG%>",$this->_path_css_default,$content);
				$content = str_replace("<%CSS_FORM_DEFAULT_TAG%>",$this->_path_css_form_default,$content);
				$content = str_replace("<%JS_DEFAULT_TAG%>",$this->_path_js_default,$content);
				$content = str_replace("<%BACKGROUND_TAG%>",$this->_path_background,$content);
				$content = str_replace("<%LAYOUT_TAG%>",$this->_layoutPath,$content);
				$content = str_replace("<%TITLE%>",ucwords($this->_page),$content);

				$this->_layoutContent = $content; 
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function mountHtml($page)
		{
			if (file_exists($this->_view.$page.".html")) {
				$handle = fopen($this->_view.$page.".html","r");
				$content = fread($handle,filesize($this->_view.$page.".html"));
				fclose($handle);

				return $content; 
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function translation()
		{
			if (file_exists($this->_translation.$this->_lang.".php")) {
				require_once($this->_translation.$this->_lang.".php");
				foreach ($idiomas as $key => $valor) {
					$this->_layoutContent = str_replace('<%'.$key.'%>',$valor,$this->_layoutContent);
				}
			} else {
				header("Location: ".$this->_support);
				exit;
			}
		}
		
		protected function setSession($data=false)
		{
			$_SESSION["PERMISSION"] = $this->_secureCode;
			if ($data) {
				$_SESSION["USER"]["ID"] = $data->id;
				$_SESSION["USER"]["NAME"] = $data->name;
				$_SESSION["USER"]["NICKNAME"] = $data->nickname;
				$_SESSION["USER"]["EMAIL"] = $data->email;
				$_SESSION["USER"]["USER"] = $data->user;
				$_SESSION["USER"]["PASSWORD"] = $data->password;
			}
		}
		
		protected function setUserData()
		{
			$this->_userPermission = $_SESSION["PERMISSION"];
			$this->_userId = (isset($_SESSION["USER"]["ID"])) ? $_SESSION["USER"]["ID"]: false;
			$this->_userName = (isset($_SESSION["USER"]["NAME"])) ? $_SESSION["USER"]["NAME"]: false;
			$this->_userNickname = (isset($_SESSION["USER"]["NICKNAME"])) ? $_SESSION["USER"]["NICKNAME"]: false;
			$this->_userEmail = (isset($_SESSION["USER"]["EMAIL"])) ? $_SESSION["USER"]["EMAIL"]: false;
			$this->_userUser = (isset($_SESSION["USER"]["USER"])) ? $_SESSION["USER"]["USER"]: false;
			$this->_userPassword = (isset($_SESSION["USER"]["PASSWORD"])) ? $_SESSION["USER"]["PASSWORD"]: false;
		}
		
		###############################################################
		###-------------------- Your Methods ----------------------###
		###############################################################
		
		
		###############################################################
		###------------------- End of Methods ---------------------###
		###############################################################
	}
	###
?>
