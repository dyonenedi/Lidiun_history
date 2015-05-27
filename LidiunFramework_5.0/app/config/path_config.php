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

	
	return [
		
		// Set dif between public_root and public_path
		'dif_root_x_public_path' => '/app/public',
		
		// Define application path for your application
		'public_path' => [
			'css' => 'css',
			'font' => 'fonts',
			'download' => 'download',
			'image' => 'image',
			'background' => 'image/bg',
			'content' => 'image/content',
			'gif' => 'image/gif',
			'icon' => 'image/icon',
			'profile' => 'image/profile',
			'plugin_type' => 'image/plugin_type',
			'js' => 'js',
			'song' => 'song',
		],

		// Define css loaded in each pages of the plication
		'common_css' => [
			'bootstrap-lidiun',
			'bootstrap-lidiun-theme',
			'bootstrap-lidiun-font',
		],
		
		// Define js to be loaded in each pages of the plication
		'common_js' => [
			'jquery.min',
			'bootstrap-lidiun',
		],
	];