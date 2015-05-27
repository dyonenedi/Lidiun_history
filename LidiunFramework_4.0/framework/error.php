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
	| Error 
	|--------------------------------------------------------------------------
	|
	| This class is responsible for writing errors log in a log file with messages that can be customized and insert into database
	|
	*/
	
	class Error
	{
		private function __construct() {
			// A private constructor; prevents direct creation of object
		}

		static function setErrorLog($file="null",$class="null",$method="null",$line="null",$level="Null") {
			$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			$referer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "Direct";
			$ip = $_SERVER["REMOTE_ADDR"];
			$date = date('H:i - d/m/Y');

			$xml = new DOMDocument("1.0", "UTF-8");
			$xml->preserveWhiteSpace = true;
			$xml->formatOutput = true;

			$errorlog = $xml->createElement("ERRORLOG");

			$level = $xml->createElement("LEVEL",$level);
			$errorlog->appendChild($level);
			$file = $xml->createElement("FILE",$file);
			$errorlog->appendChild($file);
			$class = $xml->createElement("CLASS",$class);
			$errorlog->appendChild($class);
			$method = $xml->createElement("METHOD",$method);
			$errorlog->appendChild($method);
			$line = $xml->createElement("LINE",$line);
			$errorlog->appendChild($line);
			$url = $xml->createElement("URL",$url);
			$errorlog->appendChild($url);
			$referer = $xml->createElement("REFERER",$referer);
			$errorlog->appendChild($referer);
			$ip = $xml->createElement("IP",$ip);
			$errorlog->appendChild($ip);
			$date = $xml->createElement("DATE",$date);
			$errorlog->appendChild($date);			
			
			$xml->appendChild($errorlog);
			
			$fileName = $_SERVER["DOCUMENT_ROOT"]."/../log/errorlog.xml";
			$xml->save($fileName);

			// Imprime o xml na tela
			# header("Content-Type: text/xml");
			# print $xml->saveXML();
			# exit;
		}
	}
?>