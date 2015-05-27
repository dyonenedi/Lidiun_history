<?php
	/**********************************************************
	* Lidiun 4.0 - A PHP Framework
	*
	* @Created 26/08/2013
	* @Author  Dyon Enedi <dyonenedi@hotmail.com>
	* @Modify 20/05/2014
	* @By Dyon Enedi <dyonenedi@hotmail.com>
	*
	**********************************************************/
	
	/*
	|--------------------------------------------------------------------------
	| Tools 
	|--------------------------------------------------------------------------
	|
	| This class is Responsible for give some methods that can support developers with task in the actions of the framework
	|
	*/
	
	class Tools
	{	
		// Put "-" in the CEP
        public function formatCep($cep) {
        	$cep = (int)$cep;
        	if (is_int($cep)) {
        		$cep1 = substr($cep, 0, 5);
        		$cep2 = substr($cep, 5, 7);

        		return $cep1."-".$cep2;
        	} else {
        		return "";
        	} 	
        }

		// Validate user
        public function validateUser($user) {
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
		public function validateNamePage($name){
			if (preg_match("/^[\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ\-()0-9]{3,35}$/", $name)) {
				return true;
			} else {
				return false;
			}
		}

		// Validate name
		public function validateName($name){
			if (preg_match("/^[\sabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZãâàáäêèéëîìíïõôòóöûúùüÃÂÀÁÄÊÈÉËÎÌÍÏÕÔÒÓÖÛÙÚÜçÇñÑ]{3,35}$/", $name)) {
				return true;
			} else {
				return false;
			}
		}

        // Validate user
        public function validatePassword($password) {
            if (strlen($password) <= 16 && strlen($password) >= 8) {
				return true;
             } else {
                 return false;
             }
        }
		
		// Validate name of E-mail
		public function validateEmail($email) {
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
		public function validateDate($date){
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
		public function textTreatmentShow($string) {
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
		public function stringTreatment($string) {
			if (!is_numeric($string)) {
				return strip_tags(addslashes(trim(strtolower($string))));
			} else {
				return $string;
			}
		}
		
		// Treatment of link
		public function linkTreatment($string) {
			if (!is_numeric($string)) {
				return strip_tags(addslashes(trim($string)));
			} else {
				return $string;
			}
		}

		// Treatment of the strings that have passed by get or post.
		public function textTreatment($string) {
			if (!is_numeric($string)) {
				return addslashes(nl2br(trim($string)));
			} else {
				return $string;
			}
		}

		// Treatment of link
		public function searchTreatment($string) {
			if (!is_numeric($string)) {
				$string = str_replace(array("<", ">", "\\", "/", "=", "!=", "?", "%", "*"), "", $string);
				$string = addslashes(strip_tags(trim($string)));

				return $string;
			} else {
				return $string;
			}
		}

		// Cut  strings
		public function cutString($string,$lenght,$cutWord=false){
			$string = utf8_decode($string);
			
			if (strlen($string) > $lenght) {
				if (!$cutWord) {
					$newString = substr($string, 0, $lenght-3);
					$newString .= "...";
				} else {
					$newString = substr($string, 0, $lenght);
					$pos = strrpos($newString,' ');
					if ($pos) {
						$newString = substr($string, 0, strrpos($newString,' '));
						$newString = trim($newString);
						$word = substr($newString, strrpos($newString,' '));
						$word = strtolower(trim($word));
						if ($word == "da" || $word == "das" || $word == "de" || $word == "-") {
							$newString = substr($newString, 0, strrpos($newString,' '));
						}
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

		// Identify Hashtag in a string text and put color blue
		public function identifyHashtag($text)  {
			preg_match("/(#)+([a-zA-Z0-9çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ]+)/", $text, $match);
			if (is_array($match) && count($match)) {
				$text = preg_replace("((#)+([a-zA-Z0-9çÇáéíóúýÁÉÍÓÚÝàèìòùÀÈÌÒÙãõñäëïöüÿÄËÏÖÜÃÕÑâêîôûÂÊÎÔÛ]+))",html_entity_decode("<span class=\"color_blue\">\\0</span>",ENT_COMPAT), $text);
				return $text;
			} else {
				return $text;
			}
		}

		// Find youtube id in a link on the text
		public function findIdVideo($text) {
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

		// Find youtube link on the text and replace
		public function findVideoReplace($text) {
			preg_match("/(http:\/\/|https:\/\/)?(www.)?(youtube\.)+(com|com.br{1})+(\/watch\?v=)+([a-zA-Z0-9_-\W]+)/", $text, $match);
			if (is_array($match) && isset($match[0]) && $match[0]) {
				$text = str_replace($match[0], "", $text);
				return $text;
			} else {
				preg_match("/(http:\/\/|https:\/\/)?(youtu\.)+(be\/{1})+([a-zA-Z0-9_-\W]+)/", $text, $match);
				if (is_array($match) && isset($match[0])) {
					$text = str_replace($match[0], "", $text);
					return $text;
				} else {
					return $text;
				}
			}
		}
		
		// Download file
		public function download($file,$fileName="file") {		
			if (file_exists($file)) {
				$ext = strtolower(substr(strrchr(basename($fileName),"."),1));
				switch ($ext) {
					case "pdf": $type="application/pdf"; break;
					case "exe": $type="application/octet-stream"; break;
					case "zip": $type="application/zip"; break;
					//case "rar": $type="application/rar"; break;
					case "doc": $type="application/msword"; break;
					case "xls": $type="application/vnd.ms-excel"; break;
					case "ppt": $type="application/vnd.ms-powerpoint"; break;
					case "gif": $type="image/gif"; break;
					case "png": $type="image/png"; break;
					case "jpg": $type="image/jpg"; break;
					case "mp3": $type="audio/mpeg"; break;
					case "php": // deixar vazio por seurança
					case "htm": // deixar vazio por seurança
					case "html": // deixar vazio por seurança
			    }

		        header("Content-type: ".$type);
		    	header("Content-Length: ".filesize($file));
		    	header("Content-disposition: attachment; filename=".$fileName);
		    	header("Pragma: no-cache");
		    	header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
		    	header("Expires: 0");
		    	readfile($file);
		    	flush();
			}
		}
	}
?>
	