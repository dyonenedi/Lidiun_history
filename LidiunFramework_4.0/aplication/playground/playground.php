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
	| Playground 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for freeing a space between the boot and the action of the framework
	| for developer to have fun using, creativity and developing new features for the framework
	| 
	*/

	class Playground
	{
		/*############### SINGLETON ###############*/

		static $locality = null;
		static $_instance = null;
		
		public static function Instance() {
			if (self::$_instance === null) {
				self::$_instance = new Playground();
			}
			return self::$_instance;
		}

		/*################## CODE ##################*/

		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		public function play(){
			$Locality = new Locality;
			//echo $Locality->detail["geoplugin_countryName"];
		}
	}
?>