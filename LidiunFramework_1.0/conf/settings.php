<?php
	## Config
	$this->_menu = "menu";
	$this->_footer = "footer";
	$this->_layout = "layout";
	$this->_pageDefault = "login";
	$this->_systemName = "Lidiun";
	$this->_sessionName = "Lidiun";
	$this->_secureCode = 777111;
	$this->_layoutPath = true;
	$this->_root = "D:/lidiun/htdocs/";
	##
	
	## Reservated to system
	$this->_domain = $GLOBALS["domain"];
	$this->_controlerPHP = "Controller.php";
	##
	
	## Path
	$this->_app = $this->_root."app/";
	$this->_conf = $this->_root."conf/";
	$this->_helper = $this->_root."helper/";
	$this->_log = $this->_root."log/";
	$this->_skin = $this->_root."skin/";
	$this->_translation = $this->_root."translation/";
	
	$this->_controller = "app/controller/";
	$this->_view = "app/view/";
	$this->_model = "app/model/";
	
	$this->_css = "skin/css/";
	$this->_img = "skin/img/";
	$this->_js = "skin/js/";
	
	$this->_path_background = "img/bg/bg10.jpg";
	$this->_path_favicon = "img/ico/favicon.png";
	$this->_path_css_default = "css/base_1.css";
	$this->_path_css_form_default = "";
	$this->_path_js_default = "js/j_query_1.7.2.js";
	##
	
	## Link
	$this->_home = "http://".$this->_uri."/";
	$this->_layoutPath = ($this->_layoutPath) ? "http://layout.".$this->_domain."/" : "/skin/";
	##

	## Text Fix
	$this->_copyright = "© ".$this->_systemName." ".date("Y");
	##
?>