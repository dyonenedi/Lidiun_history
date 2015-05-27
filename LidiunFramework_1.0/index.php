<?php
	###
	@ini_set("display_errors", 1);
	@ini_set("log_errors", 1);
	@ini_set("error_reporting", E_ALL);
	###
	
	###
	require_once("/conf/conf_default.php");
	###
	
	###
	if (!$GLOBALS["domain"]) {
		echo "Error, please configure site variable in '/conf/conf_default.php' line 16.";
		exit;
	}
	###
	
	### Include for handle errors
	if (file_exists("log/log.php")) {
		require_once("log/log.php");
	} else {
		if ($GLOBALS["support"] != false) {
			header("Location: ".$GLOBALS["support"]);
		} else {
			echo "Error include log page '/index.php' line 17.";
			exit;
		}
	}
	###	
	
	### Include class Image that do image stufs" 
	if (file_exists("helper/image.php")) {
		require_once("helper/image.php");
	} else {
		if ($GLOBALS["support"] != false) {
			header("Location: ".$GLOBALS["support"]);
		} else {
			echo "Error include Image Class page '/index.php' line 31.";
			exit;
		}
	}
	###	
	
	### Include class Model that have everything about mysql and conect with data basic" 
	if (file_exists("app/model/model.php")) {
		require_once("app/model/model.php");
	} else {
		if ($GLOBALS["support"] != false) {
			header("Location: ".$GLOBALS["support"]);
		} else {
			echo "Error include Model Class page '/system/system.php' line 24.";
			exit;
		}
	}
	###
		
	### Create a new object Systen and extends the object Helper
	class System extends Model 
	{	
		### Tags from path
		public $_root;
		public $_app;
		public $_conf;
		public $_helper;
		public $_log;
		public $_skin;
		public $_translator;
		public $_controller;
		public $_view;
		public $_model;
		public $_css;
		public $_img;
		public $_js;
		public $_path_background;
		public $_path_favicon;
		public $_path_css_default;
		public $_path_js_default;
		###
		
		### Links
		public $_home;
		public $_layoutPath;
		###
		
		### Text Fix
		public $_copyright;
		###
		
		### Config
		protected $_menu;
		protected $_footer;
		protected $_layout;
		protected $_pageDefault;
		protected $_systemName;
		protected $_sessionName;
		protected $_secureCode;
		###		
		
		### Tags from domain
		protected $_exUrl;
		protected $_subdomain;
		protected $_domain;
		protected $_extDominio;
		protected $_lang;
		protected $_support;
		protected $_url;
		protected $_uri;
		###
		
		### Tags from system
		protected $_parameter;
		protected $_page;
		protected $_session;
		protected $_firstView;
		protected $_user;
		protected $_content;
		protected $_menuContent;
		protected $_footerContent;
		protected $_layoutContent;
		###
		
		### Tags from User
		protected $_userPermission;
		protected $_userId;
		protected $_userName;
		protected $_userNickname;
		protected $_userEmail;
		protected $_userUser;
		protected $_userPassword;
		###
		
		function __construct()
		{
			### Set support page
			$this->_support = ($GLOBALS['support']) ? $GLOBALS['support'] : "http://www.".$GLOBALS["domain"]."/support";
			###
			
			### Set Constants
			$this->setConfig();
			###
			
			###
			session_name($this->_sessionName);
			session_set_cookie_params(0, '/', '.'.$this->_domain);
			session_start();
			###
		
			###
			ob_start();
			###
			
			### Get data of domain
			$this->getDomain();
			###
				
			### Mount array with parameter passed by url
			$parameter = $this->getParameter();
			###
			
			### Mount controller's Page.
			$this->mountController();
			###
			
			### Construct Menu, Footer and Layout
			$this->mountMenu();
			$this->mountFooter();
			$this->mountLayout();
			###
			
			### Mount Final Page
			$this->_layoutContent = str_replace("<%MENU%>",$this->_menuContent,$this->_layoutContent);
			$this->_layoutContent = str_replace("<%FOOTER%>",$this->_footerContent,$this->_layoutContent);
			$this->_layoutContent = str_replace("<%CONTENT%>",$this->_content,$this->_layoutContent);
			###
			
			### Traslation
			$this->translation();
			###

			### Show the page in the browser
			echo $this->_layoutContent;
			###
		}
		
		### Destruction
		function __destruct()
		{
			
	    }
		###
	}

	### Create a new class
	$system = new System;
	###
?>
