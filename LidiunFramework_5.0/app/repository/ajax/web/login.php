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

	class Login
	{
		public function __construct() {
			if (Validation::run()) {
				Treatment::run();
				
				$data    = Request::getParameter();
				$email    = $data['email']['email'];
				$password = Encrypt::encodePassword($data['password']['password']);
				$remindme = (!empty($data['string']['remindme']);

				$result = Building::select('*')
					->from('user')
					->where(['email' => $email, 'password' => $password, 'active' => 1])
				->run('array');

				if ($result) {
					Auth::login($remindme);

					Render::setReply(['reply' => true]);
				} else {
					Render::setReply(['reply' => false, 'message' => 'Invalid Email or password']);
				}
			} else {
				Render::setReply(['reply' => false, 'message' => Validation::getErrorMessage()]);
			}
		}
	}