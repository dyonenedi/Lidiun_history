<?php

	return [
		// Define a redirect render 
		'redirect_loged' => 'panel',
		'redirect_unloged' => 'login',
		// If access control is seted, this render require be logged
		'logged' => [
			'panel',
			'logout',
			'upapp',
		],
		// If access control is seted, this render require be unlogged
		'unlogged' => [
			'login',
			'recover',
			'recovering',
			'signin',
		],
		// If access control is seted, this render doesn't matter about the log
		'whatever' => [
			'Lidiun\Redirecting',
			'home',
			'license',
			'documentation',
			'playground',
			'about',
			'golden_box',
			'logut',
			'support',
			'not_found',
		],
	];