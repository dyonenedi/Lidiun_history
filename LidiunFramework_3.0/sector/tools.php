<?php
	/**************************************************************************
	* Lidiun - A PHP Framework
	*
	* @Created 30/12/2013
	* @author  Dyon Enedi <dyonenedi@hotmail.com>
	*
	***************************************************************************
	
	|--------------------------------------------------------------------------
	| Tools for help with somes tasks.
	|--------------------------------------------------------------------------
	|
	| Here you find somes methods that can hel you 
	| with you task in the system.
	|
	**************************************************************************/
	
	class Tools
	{	
		// Validate user
        protected function validateUser($user) {
            if (preg_match("/^[a-z0-9\._-]{3,30}$/",$user)) {
				if ($this->getSpecialUser($user)) {
					return true;
				} else {
					return false;
				} 
             } else {
                 return false;
             }
        }

		// Validate name page
		protected function validateNamePage($name){
			if (preg_match("/^[\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ\-()0-9]{3,35}$/", $name)) {
				return true;
			} else {
				return false;
			}
		}

		// Validate name
		protected function validateName($name){
			if (preg_match("/^[\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ]{3,35}$/", $name)) {
				return true;
			} else {
				return false;
			}
		}

        // Validate user
        protected function validatePassword($password) {
            if (strlen($password) <= 16 && strlen($password) >= 8) {
				return true;
             } else {
                 return false;
             }
        }
		
		// Validate name of E-mail
		protected function validateEmail($email) {
			if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{1,3})+$/", $email)) {
				if (strlen($email) <= 60) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		// Validate date
		protected function validateDate($date){
			$dataEx = explode("/",$date);
			
			if (isset($dataEx[0]) && isset($dataEx[1]) && isset($dataEx[2]) && count($dataEx) == 3){
				$d = $dataEx[0];
				$m = $dataEx[1];
				$y = $dataEx[2];

				if (strlen($y) == 4) {
					$result = checkdate($m,$d,$y);
					if ($result) {
					  return true;
					} else {
					   return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		// Treatment of the strings that have passed by get or post.
		protected function textTreatmentShow($string) {
			if (!is_numeric($string)) {
				$string = htmlspecialchars($string,ENT_COMPAT);
				$string = str_replace("&lt;br/&gt;","<br/>",$string);
				$string = str_replace("&lt;br /&gt;","<br/>",$string);
				$string = str_replace("&lt;br&gt;","<br/>",$string);
				$string = $this->identifyLink($string);
				$string = $this->identifyHashtag($string);
				return $string;
			} else {
				return $string;
			}
		}

		// Treatment of the strings that have passed by get or post.
		protected function stringTreatment($string) {
			if (!is_numeric($string)) {
				return strip_tags(addslashes(trim(strtolower($string))));
			} else {
				return $string;
			}
		}
		
		// Treatment of link
		protected function linkTreatment($string) {
			if (!is_numeric($string)) {
				return strip_tags(addslashes(trim($string)));
			} else {
				return $string;
			}
		}

		// Treatment of the strings that have passed by get or post.
		protected function textTreatment($string) {
			if (!is_numeric($string)) {
				return addslashes(nl2br(trim($string)));
			} else {
				return $string;
			}
		}
		

		// Treatment of link
		protected function nameTreatment($string) {
			if (!is_numeric($string)) {
				return strip_tags(addslashes(trim($string)));
			} else {
				return $string;
			}
		}

		// Treatment of link
		protected function searchTreatment($string) {
			if (!is_numeric($string)) {
				$string = str_replace(array("<", ">", "\\", "/", "=", "!=", "?", "%", "*"), "", $string);
				$string = addslashes(strip_tags(trim($string)));

				return $string;
			} else {
				return $string;
			}
		}

		// Cut  strings
		protected function cutString($string,$lenght,$cutWord=false){
			$string = utf8_decode($string);
			
			if (strlen($string) > $lenght) {
				if (!$cutWord) {
					$lenght = $lenght-3;
					$newString = substr($string, 0, $lenght);
					$newString .= "...";
				} else {
					$newString = substr($string, 0, $lenght);
					$pos = strrpos($newString,' ');
					if ($pos) {
						$newString = substr($string, 0, strrpos($newString,' '));
					} else {
						$newString = substr($string, 0, ($lenght-3));
						$newString .= "...";
					}
				}
			} else {
				$newString = $string;
			}
			return utf8_encode($newString);
		}
		
		// Indentify link in a string text and put btween a link
		public function identifyLink($text)  {
			preg_match("/(http:\/\/|https:\/\/)/", $text, $match);
			if (is_array($match) && count($match)) {
				$text = preg_replace("(((http:\/\/|https:\/\/)?([a-zA-Z0-9-_]{2,}[\.]{1})|(http:\/\/|https:\/\/){1})+([a-zA-Z0-9-_]{2,}[\.]{1})+([a-zA-Z\.]{2,6})([\/|\?]{1}[a-zA-Z0-9_/\-\?\.#$%&;*+,=]*)?)",html_entity_decode("<a href=\"\\0\" class=\"link\" target=\"_blank\">\\0</a>",ENT_COMPAT), $text);
				return $text;
			} else {
				$text = preg_replace("(((http:\/\/|https:\/\/)?([a-zA-Z0-9-_]{2,}[\.]{1})|(http:\/\/|https:\/\/){1})+([a-zA-Z0-9-_]{2,}[\.]{1})+([a-zA-Z\.]{2,6})([\/|\?]{1}[a-zA-Z0-9_/\-\?\.#$%&;*+,=]*)?)",html_entity_decode("<a href=\"http://\\0\" class=\"link\" target=\"_blank\">\\0</a>",ENT_COMPAT), $text);
				return $text;
			}
		}

		// identify Hashtag in a string text and put color blue
		public function identifyHashtag($text)  {
			preg_match("/(#)+([a-zA-Z0-9]+)/", $text, $match);
			if (is_array($match) && count($match)) {
				$text = preg_replace("((#)+([a-zA-Z0-9]+))",html_entity_decode("<span class=\"color_blue\">\\0</span>",ENT_COMPAT), $text);
				return $text;
			} else {
				return $text;
			}
		}

		// Find youtube id in a link on the text
		protected function findIdVideo($text) {
			preg_match("/(http:\/\/|https:\/\/)?(www.)?(youtube\.)+(com|com.br{1})+(\/watch\?v=)+([a-zA-Z0-9_-]+)/", $text, $match);
			if (is_array($match) && isset($match[0]) && $match[0]) {
				$exMatch = explode("/watch?v=", $match[0]);
				return $exMatch[1];
			} else {
				preg_match("/(http:\/\/|https:\/\/)?(youtu\.)+(be\/{1})+([a-zA-Z0-9_-]+)/", $text, $match);
				if (is_array($match) && isset($match[0])) {
					$exMatch = explode("youtu.be/", $match[0]);
					return $exMatch[1];
				} else {
					return false;
				}
			}
		}
		
		// Cut word in a determinate number
		protected function cutWord($string,$number) {
			if (strlen($string) > $number) {
				$newString = substr(utf8_decode($string), 0, ($number-3));
				$newString .= "...";
			} else {
				$newString = utf8_decode($string);
			}
			return utf8_encode($newString);
		}
		
		// Download file
		protected function download($filePath,$fileName) {		
			if (!file_exists($filePath)) {
				return false;
			} else {
				header('Content-Description: File Transfer');
				header('Content-Disposition: attachment; filename='.$fileName.' ');
				header('Content-Type: application/octet-stream');
				header('Content-Transfer-Encoding: binary');
				header('Content-Length: ' . filesize($filePath));
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Expires: 0');
				
				readfile($filePath);
				return true;
			}
		}

		// Class to send E-mail
		protected function sendEmail($email,$subject,$html){
			$mail = new PHPMailer();
			
			$mail->Charset = 'UTF-8';
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP
			$mail->Port = 465; 
			$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
			$mail->Username = 'E-mail'; // Usuário do servidor SMTP
			//$mail->Password = 'mxmuwsieoysrdxnm'; // Senha do servidor SMTP dyonenedi@gmail.com
			$mail->Password = 'password'; // Senha do servidor SMTP wittleApp@gmail.com
			$mail->From = "E-mail";
			$mail->FromName = "Name";
			$mail->AddAddress($email);
			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			$mail->Subject  = $subject; // Assunto da mensagem
			$mail->Body = $html;
			
			## Envia o e-mail
			if(!$mail->Send()) {
				return false;
			} else {
				return true;
			}
		}
				

		// Show the array in the page indented
		protected function showObj($obj,$property=false) {
			echo "<pre>";
			if ($property) {
				if (property_exists($obj,$property)) {
					print_r($obj->$property);
				} else {
					echo "This property do not exist.";
				}
			} else if(is_object($obj)) {
				print_r($obj);
			} else {
				echo "This is not a object.";
			}
			exit;
		}
		
		// Show the array in the page indented
		protected function showArray($array,$key=false) {
			echo "<pre>";
			if($key){
				print_r($array[$key]);
			} else {
				print_r($array);
			}
			exit;
		}
	}
?>
	