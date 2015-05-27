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

	try {
		define('PUBLIC_DIRECTORY', __DIR__);
		if (!include_once('../../lidiun/adapter.php')) {
			throw new \ExceptionException('I can\'t find adapter.php file in: '.__FILE__.' on line: '.__LINE__);
		}
	} catch (\ExceptionException $e) {
		echo $e->getMessage().'<pre>'.$e->getTraceAsString();
		exit();
	}
