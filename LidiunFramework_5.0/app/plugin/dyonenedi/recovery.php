<?php
	
	namespace App\Plugin\Dyonenedi;
	
	use Lidiun\Building;
	
	use Lidiun\Request;
	use Lidiun\Render;
	use Lidiun\Path;
	use Lidiun\Conf;

	class Recovery
	{
		private $email;
		private $token;
		private $password;
		
		public $errorMessage;
		
		public function __construct($email){
			$this->email = $email;
		}

		public function generateToken(){
			$result = Building::select()
				->from('user')
				->where(['email' => $email, 'active' => 1])
			->run('num_rows');
			
			if ($result) {
				$this->token = uniqid(rand(), true);

				Building::insert()
					->into('token_recover')
					->values(['token' => $this->token, 'email' => $email])
				->run('num_rows');

				return true;
			} else {
				$this->errorMessage = 'This Email is not found.';
				
				return false;
			}
		}

		public function sendEmail(){
			if (true) {
				return true;
			} else {
				$this->errorMessage = 'We can not send Email to you right now. Try again later.';
				
				return false;
			}
		}

		public function validateToken(){
			
		}

		public function deactiveToken(){
			
		}

		public function changePassword(){
			
		}
	}