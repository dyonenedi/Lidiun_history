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
	use Lidiun\Database;
	
	class Playground
	{
		public function __construct() {
			$segment = Layout::getSegment('plugin_box');
			$content = ''; 

			$result = Database::query('SELECT A.type_id, A.name, A.description, B.first_name AS developer, A.link, A.date FROM plugin AS A INNER JOIN user AS B ON A.user_id = B.id', 'object');
			foreach ($result as $data) {
				$content .= $segment;
				$content = Layout::replaceSegment('image', $data->type_id, $content);
				$content = Layout::replaceSegment('name', $data->name, $content);
				$content = Layout::replaceSegment('description', substr($data->description,0 ,100), $content);
				$content = Layout::replaceSegment('developer', $data->developer, $content);
				$content = Layout::replaceSegment('link', $data->link, $content);
				$content = Layout::replaceSegment('date', $data->date, $content);
			}
			Layout::replaceContent('block', $content);
		}
	}