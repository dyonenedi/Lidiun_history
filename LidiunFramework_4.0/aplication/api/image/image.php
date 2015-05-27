<?php
class Image
{
	public $error = "";

	public function validateImage($file,$megabyteMax,$widhtMim,$widhtMax,$heightMim,$heightMax){
		$image = $file['tmp_name'];
		$size = $file['size'] ; // Em bytes
		$type = $file['type']; // Extensão do arquivo
		$explode = explode("image/",$type);
		$type = isset($explode[1]) ? $explode[1] : $file['type'];

		$imgInfo = getimagesize($image);
		$width = $imgInfo[0]; // Largura
		$height = $imgInfo[1]; // Altura
		
		if ($size > $megabyteMax) {
			$this->error = '<%FOTO_GRANDE_MB_TEXT%>'.$megabyteMax."MB";
			return false;
		} else if ($width > $widhtMax || $height > $heightMax) {
			$this->error = '<%FOTO_GRANDE_PX_TEXT%>'.$widhtMax.'px por '.$heightMax.'px';
			return false;
		} else if ($width < $widhtMim || $height < $heightMim) {
			$this->error = '<%FOTO_PEQUENA_PX_TEXT%>'.$widhtMim.'px por '.$heightMim.'px';
			return false;
		} else if ($type != "jpg" && $type != "jpeg" && $type != "png") {
			$this->error = '<%FOTO_INVALIDA_EXT_TEXT%>';
			return false;
		} else {
			return true;
		}
	}
	
	## Salva um arquivo no caminho desejado
	public function saveImage($tempName,$pathUser,$pathImage,$imagePath,$type,$width){

		if (!file_exists($pathUser)) {
			mkdir($pathUser);
			chmod($pathUser, 0777);
		}


		if (!file_exists($pathImage)) {
			mkdir($pathImage);
			chmod($pathImage, 0777);
		}
	
		if (move_uploaded_file($tempName,$imagePath)) {
			$explode = explode("image/",$type);
			$type = isset($explode[1]) ? $explode[1] : $file['type'];
			if ($type == 'png') {
				$img = imagecreatefrompng($imagePath);
			} else if ($type == 'jpg' || $type == 'jpeg') {
				$img = imagecreatefromjpeg($imagePath);
			} else {
				$this->error = '<%FOTO_INVALIDA_EXT_TEXT%>';
				return false;
			}			
			$originalWidth = imagesX($img);
			$originalHeight = imagesY($img);
			$newWidth = (int)($originalHeight * $width)/$originalWidth;
			$newImg = ImageCreateTrueColor($width,$newWidth);
			$white = imagecolorallocate($newImg, 255, 255, 255);
			imagefill($newImg, 0, 0, $white);
			imagecopyresampled($newImg, $img, 0, 0, 0, 0, $width, $newWidth, $originalWidth, $originalHeight);
			if (imagejpeg($newImg,$imagePath,95)) {
				return true;
			} else {
				$this->error = "<%FOTO_ERROR_TEXT%>";
				return false;
			}
		} else {
			$this->error = "<%FOTO_ERROR_TEXT%>";
			return false;
		}
		
	}

	## Redimenciona a imgem apartir de putra
	public function copyImage($path,$imagePath,$newImagePath,$type,$width){
		$explode = explode("image/",$type);
		$type = isset($explode[1]) ? $explode[1] : $file['type'];
		if ($type == 'png') {
			$img = imagecreatefrompng($imagePath);
		} else if ($type == 'jpg' || $type == 'jpeg') {
			$img = imagecreatefromjpeg($imagePath);
		} else {
			$this->error = '<%FOTO_INVALIDA_EXT_TEXT%>';
			return false;
		}			
		$originalWidth = imagesX($img);
		$originalHeight = imagesY($img);
		$newWidth = (int)($originalHeight * $width)/$originalWidth;
		$newImg = ImageCreateTrueColor($width,$newWidth);
		$white = imagecolorallocate($newImg, 255, 255, 255);
		imagefill($newImg, 0, 0, $white);
		imagecopyresampled($newImg, $img, 0, 0, 0, 0, $width, $newWidth, $originalWidth, $originalHeight);
		if (imagejpeg($newImg,$newImagePath,95)) {
			return true;
		} else {
			$this->error = "<%FOTO_ERROR_TEXT%>";
			return false;
		}
	}
	
	public function cropImage($src,$path,$photoName,$width,$height,$x,$y,$w,$h){
		$img = imagecreatefromjpeg($src);
		$newImage = ImageCreateTrueColor($width,$height);
		imagecopyresampled($newImage,$img,0,0,$x,$y,$width,$height,$w,$h);
		if (imagejpeg($newImage, $path.$photoName,95)) {
			return true;
		} else {
			return false;
		}
		
		## Show image in display...
		## header('Content-type: image/jpeg');
		## imagejpeg($dst_r_3, null, $jpeg_quality);
	}
}
?>
