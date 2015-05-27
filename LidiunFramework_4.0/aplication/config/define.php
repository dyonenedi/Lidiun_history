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
	| Define 
	|--------------------------------------------------------------------------
	|
	| This file define system constants
	|
	*/
	
	// Set constants of the system
	define("NAME", "Lidiun Framework");
	define("DOMAIN", "git.com.br.");
	define("COPYRIGHT", "© ".date("Y")." ".NAME."");
	define("DESCRIPTION", "Lidiun é um framework feito para trabalhar em linguagens PHP e Mysql. Criado em um novo designer pattern chamado 'Sector', você tem agilidade, praticidade e muita liberdade em seus projetos. Faça o download gratis.");
	define("KEY_WORDS", "Lidiun, Framework, php, mysql, sector, fácil, rápido, download, gratis");
	define("AUTHOR", "Dyon Enedi");
	define("AUTHOR_EMAIL", "dyonenedi@hotmail.com");
	
	// Set your default language here like: pt-br, en-us...
	define("LANGUAGE_DEFAULT", "pt-br");

	// Set yout location here like: America/Sao_Paulo, America/New_York...
	define("TIMEZONE", "America/Sao_Paulo");

	// Set presets of the Lidiun Framework
	define("STATEMENT", DOMAIN);
	define("PRODUTION", DOMAIN);
	define("SUPPORT", false);
	define("CONECT_DB", false);
	define("SESSION_CODE", "AdrRm47U");
	define("SECURITY_LEVEL", true);
	define("DENY_IE", false);
	define("PAGE_HOME_LOGGED", "home");
	define("PAGE_HOME_UNLOGGED", "home");
	define("DISPLAY_MENU", true);
	define("DISPLAY_FOOTER", true);
	
	// Set background like: define("BACKGROUND", "bg.jpg"); If set false, it's gonna get background color by default in css/bootstrap_modifier.css: #system_content
	define("BACKGROUND", "");

	// Set Prodution Database
	define("DB_P_HOST_NAME", "localhost");
	define("DB_P_DB_NAME", "lidiun");
	define("DB_P_USER_NAME", "root");
	define("DB_P_PASSWORD", "");

	// Set Statement Database
	define("DB_S_HOST_NAME", "localhost");
	define("DB_S_DB_NAME", "lidiun");
	define("DB_S_USER_NAME", "root");
	define("DB_S_PASSWORD", "");

	// Set Local Database
	define("DB_L_HOST_NAME", "localhost");
	define("DB_L_DB_NAME", "lidiun");
	define("DB_L_USER_NAME", "root");
	define("DB_L_PASSWORD", "");
?>