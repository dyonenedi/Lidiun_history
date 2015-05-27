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

	class Recovering
	{
		public function __construct() {
			if (Validation::run()) {
				Treatment::run();
				
				$data     = Request::getParameter();
				$email    = $data['email']['email'];
				$token    = $data['string']['token'];
				$password = $data['password']['password'];

				$result = Building::select()
					->from('user AS A')
					->with('token_recover AS B')
					->where(['A.email' => $email, 'B.token' => $token, 'A.active' => 1, 'B.active' => 1])
				->run('num_rows');

				if ($result) {
					if (Auth::recovering($email, $password, $token)) {
						Render::setReply(['reply' => true, 'message' => 'Your passwor be changed']);
					} else {
						Render::setReply(['reply' => true, 'message' => 'We can not change password right now. Try again later.']);
					}
				} else {
					Render::setReply(['reply' => false, 'message' => 'Invalid Email or password']);
				}
			} else {
				Render::setReply(['reply' => false, 'message' => Validation::getErrorMessage()]);
			}
		}
	}