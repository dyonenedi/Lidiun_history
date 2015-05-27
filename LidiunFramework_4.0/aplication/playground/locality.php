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
	| Locality 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for get locality of youser bu ip and show or save this information.
	| 
	*/

	class Locality
	{
		/*################## CODE ##################*/
		private $Ipdetails;
		public $detail;

		public function __construct() {
			$this->Ipdetails = new Ipdetails('179.186.194.65');
			$this->Ipdetails->scan();
			$this->detail = $this->Ipdetails->get_details_by_array();
		}
	}
?>