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
	
	use Lidiun\Request;
	use Lidiun\Render;
	
	use App\Plugin\Dyonenedi\Validation;
	use App\Plugin\Dyonenedi\Treatment;
	use App\Plugin\Dyonenedi\Building;
	use App\Plugin\Dyonenedi\Auth;
	use App\Plugin\Dyonenedi\Encrypt;

	class Recover
	{
		public function __construct() {
			if (Validation::run()) {
				Treatment::run();
				
				$data = Request::getParameter();
				$email = $data['email']['email'];

				$recovery = New Recovery($email);
				if ($recovery->generateToken()) {
					if ($recovery->sendEmail()) {
						Render::setReply(['reply' => true, 'message' => 'An Email has been sent to you with recovery link.']);
					} else {
						Render::setReply(['reply' => false, 'message' => $recovery->errorMessage]);
					}
				} else {
					Render::setReply(['reply' => false, 'message' => $recovery->errorMessage]);
				}
			} else {
				Render::setReply(['reply' => false, 'message' => Validation::getErrorMessage()]);
			}
		}
	}