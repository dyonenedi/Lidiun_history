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
	
	use Lidiun\Render;
	use Lidiun\Layout;
	use Lidiun\Redirect;
	use App\Plugin\Dyonenedi\Auth;

	class Global_render
	{
		public function __construct() {	
			//Render::setDenyIe(true);

			//Auth::setSecurityLevel();

			Render::setDenyIe(true);
			Layout::renderMenu(true);
			Layout::renderfOOTER(true);
			
			if (Auth::getLogged()) {
				Layout::replaceMenu('PANEL', '<li class="bold <%PAN_ACTIVE%>"><a href="/panel/"><%PANEL_TR%></a></li>');
			} else {
				Layout::replaceMenu('PANEL', '');
			}

			$panActive = (Render::getRender() == 'panel') ? 'active': '';
			$homActive = (Render::getRender() == 'home') ? 'active': '';
			$aboActive = (Render::getRender() == 'about') ? 'active': '';
			$plaActive = (Render::getRender() == 'playground') ? 'active': '';
			$docActive = (Render::getRender() == 'documentation') ? 'active': '';
			$logActive = (Render::getRender() == 'login') ? 'active': '';

			Layout::replaceMenu('PAN_ACTIVE', $panActive);
			Layout::replaceMenu('HOM_ACTIVE', $homActive);
			Layout::replaceMenu('ABO_ACTIVE', $aboActive);
			Layout::replaceMenu('PLA_ACTIVE', $plaActive);
			Layout::replaceMenu('DOC_ACTIVE', $docActive);
			
			if (Auth::getLogged()) {
				Layout::replaceMenu('LOG_ACTIVE', $logActive);
				Layout::replaceMenu('LOGIN', "<%LOGOUT_TR%>");
				Layout::replaceMenu('LOGIN_LINK', "logout");
			} else {
				Layout::replaceMenu('LOG_ACTIVE', '');
				Layout::replaceMenu('LOGIN', "");
				Layout::replaceMenu('LOGIN_LINK', "login");
			}

			Layout::replaceLayout('message_bar', Layout::getSegment('system/message_bar'));
		}
	}