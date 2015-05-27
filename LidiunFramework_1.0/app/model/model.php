<?php
	### Include class Helper that have tools like " E-Mail sender, Crop-Image, Counter and very more" 
	if (file_exists("helper/helper.php")) {
		require_once("helper/helper.php");
	} else {
		if ($GLOBALS["support"] != false) {
			header("Location: ".$GLOBALS["support"]);
		} else {
			echo "Error include Helper Class page '/app/model/model.php' line 3.";
			exit;
		}
	}
	###

	###
	class Model extends Helper
	{
		private $db_host = '';
		private $db_user = '';
		private $db_password = '';
		private $db_name = '';
		private $connection = '';

		## Construct the constants
		private function construct()
		{
			$server = $_SERVER['SERVER_NAME'];
			if ( $server == "http://www.".$GLOBALS["domain"])
			{
				## Base text
				$this->db_host = 'localhost';
				$this->db_name = 'myDbName';
				$this->db_user = 'User';
				$this->db_password   = 'Password';
				##
			}else{
				## Base production
				$this->db_host = '127.0.0.1';
				$this->db_name = 'myDbname';
				$this->db_user = 'root';
				$this->db_password   = '';
				##
			}
		}
		##
		
		## Connect whit the data base
		private function connect()
		{
			$this->connection = mysql_connect( $this->db_host, $this->db_user, $this->db_password );
			if ( $this->connection )
			{
				return true;
			}else{
				return false;
			}
		}
		##
		
		## Disconnect of the data base
		private function disconnect()
		{
			mysql_close( $this->connection );
		}
		##
		
		## Run query
		private function query($query)
		{
			$this->construct();
			$connect = $this->connect();
			if ($connect)
			{ 
				$db_selected = mysql_select_db($this->db_name); 
				$result = mysql_query($query);
				$this->disconnect();
				if ($result)
				{ 
					return $result;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		###	
	
		#################################################################################
		##------------------------------- Protected Methods----------------------------##
		#################################################################################
		
		## Run coaunt lines
		protected function toRows( $result )
		{
			if(mysql_num_rows($result)){
				return true;
			}else{
				return false;
			}
		}
		###
		
		## Metodo to run mysql_fetch_array
		protected function toArray( $result )
		{
			return mysql_fetch_array($result);
		}
		##
		
		## Metodo to run mysql_fetch_assoc
		protected function toAssoc( $result )
		{
			return mysql_fetch_assoc($result);
		}
		##
		
		## Metodo to run mysql_fetch_object
		protected function toObject( $result )
		{
			return mysql_fetch_object($result);
		}
		##
		
		## Metodo to return id of the connection
		protected function id()
		{
			return mysql_insert_id($this->conection);
		}
		##
		
		########################################################################
		# Here you must to criet a protected functon to execute the query and  #
		# send return to controller.                                           #
		########################################################################
		
		
		
		##
	}		
	### create a new class
	$system = new Model;
	###
?>