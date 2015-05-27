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
	| Database 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for creating the connection to the database
	|
	*/
	
	class Database
	{
		/*############### SINGLETON ###############*/

		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Database();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		private $Conf = false;
		private $Support = false;
		public $_db = false;
		public $_con = false;
		
		public function setConnection() {
			$this->Conf = Conf::Instance();
			$this->Support = Support::Instance();

			if ($this->Conf->_preset["connect"]) {
				if ($this->Conf->_localServer == "local") {
					$this->_db["host"] = DB_L_HOST_NAME;
					$this->_db["name"] = DB_L_DB_NAME;
					$this->_db["user"] = DB_L_USER_NAME;
					$this->_db["passwd"] = DB_L_PASSWORD;
				} elseif($this->Conf->_localServer == "statement") {
					$this->_db["host"] = DB_S_HOST_NAME;
					$this->_db["name"] = DB_S_DB_NAME;
					$this->_db["user"] = DB_S_USER_NAME;
					$this->_db["passwd"] = DB_S_PASSWORD;
				} elseif($this->Conf->_localServer == "production") {
					$this->_db["host"] = DB_P_HOST_NAME;
					$this->_db["name"] = DB_P_DB_NAME;
					$this->_db["user"] = DB_P_USER_NAME;
					$this->_db["passwd"] = DB_P_PASSWORD;
				}

				$this->_con = @new mysqli($this->_db["host"],$this->_db["user"],$this->_db["passwd"],$this->_db["name"]);
				if (mysqli_connect_errno()) {
					$this->_con = false;
					$this->Support->pageSupport();
				} else {
					$this->_con->query("SET NAMES 'utf8'");
					$this->_con->query('SET character_set_con=utf8');
					$this->_con->query('SET character_set_client=utf8');
					$this->_con->query('SET character_set_results=utf8');
				}
			}
		}

		public function __destruct() {
			if ($this->_con) {
				mysqli_close($this->_con);
				$this->_db = null;
			}
		}
	}
?>