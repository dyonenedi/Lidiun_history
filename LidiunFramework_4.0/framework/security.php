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
	| Security 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for the Lidiun framework security
	|
	*/
	
	class Security
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Security();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}
		
		private $Conf = false; 
		private $Support = false;  
		private $_securitySeted = null;  
		public $_logged = null;   

		public function setBrowse() {
			$this->Support = Support::Instance();

			if (DENY_IE) {
				$browser = $_SERVER['HTTP_USER_AGENT'];
				if (preg_match('/MSIE/i', $browser)) {
					$this->Support->pageBrowse();		
				}
			}
		}
		
		public function startSession() {
			$this->Conf = Conf::Instance();
			
			if (!isset($_SESSION)) {
				session_name($this->Conf->_preset["sessionName"]);
				session_set_cookie_params(0, '/', '.'.$this->Conf->_url["domain"]);
				session_start();
			}
		}

		public function setLogged() {
			if (isset($_SESSION["LOGGED"]) && $_SESSION["LOGGED"]) {
				$this->_logged = true;
			} else {
				$this->_logged = false;
			}
		}

		public function setSource() {			
			if ($this->Conf->_url["subdomain"] == "source") {
				if ($this->Conf->_localServer == "local" || $this->Conf->_localServer == "statement") {
					$System = System::Instance();
					Display::show($System);
				} else {
					$this->Support->redirectHome();
					exit();
				}
			} else {
				if ($this->Conf->_preset["support"]) {
					$this->Support->pageSupport();
				}
			}
		}

		public function setSecurityLevel($permission=false){
			if ($permission && ($permission == "public" || $permission == "private" || $permission == "protected")) {
				if ($permission == "private") {
					if ($this->_logged == false) {
						$this->Support->pageNotFound();
						exit();
					} else {
						$this->_securitySeted = true;
					}
				} elseif ($permission == "protected") {
					if ($this->_logged == true) {
						$this->Support->pageNotFound();
						exit();
					} else {
						$this->_securitySeted = true;
					}
				} elseif ($permission == "public") {
					$this->_securitySeted = true;
				}
			} else {
				echo "Set Security Level in action with: <br/><br/> \$this->Security->setSecurityLevel('public'); <br/> or <br/> \$this->Security->setSecurityLevel('private'); <br/> or <br/> \$this->Security->setSecurityLevel('protected');";
				exit();
			}
		}

		public function getSecurityLevel(){
			if (!isset($this->_securitySeted) && $this->Conf->_preset["securityLevel"]) {
				echo "Disable security level in 'Define.php' or set security level in action (recommended) with: <br/><br/> \$this->Security = Security::Instance(); <br/> \$this->Security->setSecurityLevel('public'); <br/> or <br/> \$this->Security->setSecurityLevel('private'); <br/> or <br/> \$this->Security->setSecurityLevel('protected');";
				exit();
			}
		}
	}
?>