<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Data Base 
	|--------------------------------------------------------------------------
	|
	| This file has the databese settings
	|
	**************************************************************************/

	class Database
	{
		public $db;
		public $connection = false;
		public $error = false;
		
		public function __construct($localServer) {
			if ($localServer == "local") {
				$this->db["host"] = "localhost";
				$this->db["user"] = "root";
				$this->db["passwd"] = "";
				$this->db["name"] = "databse_name";
			} elseif($localServer == "production") {
				$this->db["host"] = "localhost";
				$this->db["user"] = "root";
				$this->db["passwd"] = "";
				$this->db["name"] = "databse_name";
			}
		}
		
		public function connect() {
			$this->connection = @new mysqli($this->db["host"],$this->db["user"],$this->db["passwd"],$this->db["name"]);
			if (mysqli_connect_errno()) {
				$this->connection = false;
				return false;
			} else {
				$this->connection->query("SET NAMES 'utf8'");
				$this->connection->query('SET character_set_connection=utf8');
				$this->connection->query('SET character_set_client=utf8');
				$this->connection->query('SET character_set_results=utf8');
				return 	$this->connection;
			}
		}
		
		public function disconnect() {
			if ($this->connection) {
				mysqli_close($this->connection);
			}
		}

		public function __destruct() {
			$this->disconnect();
		}
	}
?>