<?php
	
	Use Lidiun\Layout;
    Use Lidiun\Database;

	Class golden_box 
	{
		function __construct() {
			Layout::renderMenu(false);
			Layout::renderFooter(false);
			
			Layout::addJs('golden_box');

			$data = Database::query("SELECT first_name FROM user WHERE id = 1", "object");
			if (Database::getErrorMessage()) {
				exit(Database::getErrorMessage());
			}

			$userName = $data[0]->first_name;
			Layout::replaceContent('user_name', $userName);

			$segment = Layout::getSegment('picture');
			$segment = Layout::replaceSegment('link', 'dyonnnnnnnnnn.jpg', $segment);
			Layout::replaceContent('picture', $segment);
		}
	}