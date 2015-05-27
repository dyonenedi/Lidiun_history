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

	class About
	{
		public function __construct() {
			$userBoxs = "";
			
			$developers[] = ['name' => 'Dyon Enedi', 'position' => '<%DEVELOPER_TR%>', 'photo' => 'dyon.jpg'];
			$developers[] = ['name' => 'André Teixeira', 'position' => '<%COLABORATOR_TR%>', 'photo' => 'andre.jpg'];
			$developers[] = ['name' => 'Rodolfo Bulati', 'position' => '<%COLABORATOR_TR%>', 'photo' => 'rodolfo.jpg'];
			$developers[] = ['name' => 'You', 'position' => '<%COLABORATOR_TR%>', 'photo' => 'you.jpg'];

			foreach ($developers as $developer) {
				$userBoxs .= Layout::getSegment('user_box');
				$userBoxs = Layout::replaceSegment('name', $developer['name'], $userBoxs);
				$userBoxs = Layout::replaceSegment('position', $developer['position'], $userBoxs);
				$userBoxs = Layout::replaceSegment('photo', '<%PROFILE_PATH%>'.$developer['photo'], $userBoxs);
			}

			Layout::replaceContent('user_box', $userBoxs);
		}
	}