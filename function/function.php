<?php
class FunctionCode{
	public function getFile($path){
		$dir = new DirectoryIterator($path);
		$arrName = array();

		foreach ($dir as $fileinfo) {
		    if (!$fileinfo->isDir()) {
			array_push($arrName,$fileinfo->getFileName()) ;
		    }
			
		}
		return $arrName;
	}

	public function getFodel($path){
		$dir = new DirectoryIterator($path);
		$arrName = array();
		foreach ($dir as $fileinfo) {
		    if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			array_push($arrName,$fileinfo->getFileName()) ;
	  	  }
		
		}
	return $arrName;
 }

  public function createImage($huyhieu,$tuong,$name,$pos){
	$targetfile = 'temp/'.md5(uniqid(mt_rand(), true)).".jpg"; 
	$photo = imagecreatefromjpeg($tuong); 
	$fotoW = imagesx($photo); 
	$fotoH = imagesy($photo); 
	$logoImage = imagecreatefrompng($huyhieu); 
	$logoW = imagesx($logoImage); 
	$logoH = imagesy($logoImage); 
	$photoFrame = imagecreatetruecolor($fotoW,$fotoH); 
	$dest_x = $fotoW - $logoW; 
	$dest_y = $fotoH - $logoH; 
	imagecopyresampled($photoFrame, $photo, 0, 0, 0, 0, $fotoW, $fotoH, $fotoW, $fotoH); 
	imagecopy($photoFrame, $logoImage, $dest_x, $dest_y, 0, 0, $logoW, $logoH); 
	imagejpeg($photoFrame, $targetfile,100);  
	imagedestroy($photoFrame);
	imagedestroy($photo);
	imagedestroy($logoImage);
	$images =imagecreatefromjpeg($targetfile);;	
	$color = imagecolorallocate($images,255,204,51); 
	$font_file = 'function/helvetica.ttf';
	imagettftext($images,17,0,172,72,$color,$font_file,$name);
	imagettftext($images,17,0,176,122,$color,$font_file,$pos);
	imagettftext($images,10,0,30,300,$color,$font_file,'FB.COM/TIMELINELOL');
	if (!file_exists('images')) {
		mkdir('images', 0777, true);
	}
	$filename= md5(uniqid(mt_rand(), true)).'.jpg';
	$imagesname = 'images/'.$filename;
	imagejpeg($images,$imagesname,100);
	unlink($targetfile);
	return $imagesname;
 }
}
?>