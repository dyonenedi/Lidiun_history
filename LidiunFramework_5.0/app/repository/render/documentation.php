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
	use Lidiun\Request;
	use App\Plugin\Dyonenedi\Treatment;

	class Documentation
	{
		public function __construct() {
			Layout::addJs('documentation');
			Layout::addCss('documentation');

			Treatment::run();
			
			$active1 = '';
			$active2 = '';
			$active3 = '';
			$active4 = '';

			$parameter = Request::getParameter();
			if (!empty($parameter[1]) && $parameter[1] == 'structure') {
				$step = Layout::getSegment('documentation/structure');
				$active2 = 'active';
			} else if (!empty($parameter[1]) && $parameter[1] == 'tutorial') {
				$step = Layout::getSegment('documentation/tutorial');
				$active3 = 'active';
			} else if (!empty($parameter[1]) && $parameter[1] == 'native') {
				$step = Layout::getSegment('documentation/native');
				$active4 = 'active';
			} else {
				$step = Layout::getSegment('documentation/design_pattern');
				$active1 = 'active';
			}

			Layout::replaceContent('1_ACTIVE', $active1);
			Layout::replaceContent('2_ACTIVE', $active2);
			Layout::replaceContent('3_ACTIVE', $active3);
			Layout::replaceContent('4_ACTIVE', $active4);

			Layout::replaceContent('STEP', $step);
		}
	}