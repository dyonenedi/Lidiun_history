<?php
	/**********************************************************
	* Lidiun PHP Framework 4.0 - (http://www.lidiun.com)
	*
	* @Created in 26/08/2013
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @Modify in 04/08/2014
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	* @Contributor Gabriela A. Ayres Garcia <gabriela.ayres.garcia@gmail.com>
	* @Contributor Rodolfo Bulati <rbulati@gmail.com>
	* @License: free
	*
	**********************************************************/
	
	use Lidiun\Layout;

	class Signin
	{
		public function __construct() {
			Layout::addJs('signin');
			Layout::replaceContent('signin',Layout::getSegment('form/signin'));
		}
	}