<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Error Class 
	|--------------------------------------------------------------------------
	|
	| This class will write logs into "/../log/errorlog.txt"
	| To call this class use static method like this example: Error::log("Some message error",int(type),__FILE__,__CLASS__,__METHOD__,__LINE__);
	| Type is a int number that represent the type of error.
	| Types: 1 = security, 2 = query, 3 = controller, 4 = framework
	|
	**************************************************************************/
	
	class Error
	{
		static function log($error,$userId,$type,$file,$class,$method,$line) {
			$type = (is_int($type)) ? $type : 6;
			$error = "Error: ".$error."<br/>File: ".$file."<br/>Class: ".$class."<br/>Method: ".$method."<br/>Line: ".$line;
			$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			$referer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "Direct";
			$ip = $_SERVER["REMOTE_ADDR"];
			$date = date('H:i - d/m/Y');
			
			$fileName = $_SERVER["DOCUMENT_ROOT"]."/../log/errorlog.txt";
			$errorlog = "<ERRORLOG>\n\t<ID_USER>".$userId."</ID_USER>\n\t<TYPE>".$type."</TYPE>\n\t<ERROR>".$error."</ERROR>\n\t<URL>".$url."</URL>\n\t<REFERER>".$referer."</REFERER>\n\t<IP>".$ip."</IP>\n\t<DATE>".$date."<DATE>\n</ERRORLOG>\n";

			if (!file_exists($fileName)) {
				$handle = fopen($fileName, "r+");
				fseek($handle, 1);
				fwrite($handle, $errorlog);
				fclose($handle);
			} else {
				$handle = fopen($fileName, "a+");
				$pos = ftell($handle);
				if ($pos == 0) {fseek($handle, 1);}
				fwrite($handle, $errorlog, strlen($errorlog));
				fclose($handle);
			}
		}
	}
?>