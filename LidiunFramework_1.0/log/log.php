<?php
	###
	function salvarErro($err_no, $err_desc, $err_file, $err_line) 
	{
		$strTexto = "Error number: ".$err_no."\n Error description: ".$err_desc."\n file:".$err_file."\n linha ".$err_line."\n";
		$time = date("H:i:s");
		
		if (file_exists("error/log.txt")) {
			$arquivo = fopen("error/log.txt","a");
			fwrite($arquivo, $time." - ".$strTexto." \n");
			fclose($arquivo);
		}
	}
		
	set_error_handler('salvarErro');
	###
?>