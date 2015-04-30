<?php
	
 $html = '';
 $success = '';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $img = '';
     if (!isset($_POST['charname'])||empty($_POST['charname'])) {
         $html .= 'Bạn chưa nhập tên nhân vật';
     }
      elseif (!isset($_POST['pos'])||empty($_POST['pos'])) {
         $html .= 'Bạn chưa nhập vị trí VD : Top';
    } 
     elseif (!isset($_POST['champ'])||empty($_POST['champ'])) {
       $html .= 'Bạn phải chọn hoặc tải 1 hình ảnh để làm ảnh nền.';  
     }else{
        $charname = $_POST['charname'];
        $pos = $_POST['pos'];
        $imgsrc = $_POST['champ'];
        $rank =$_POST['rank'];
        $srcRank = 'img/rank/'.$rank;
        $targetfile = 'temp/'.md5(uniqid(mt_rand(), true)).".jpg"; 
		$photo = imagecreatefromjpeg($imgsrc); 
		$fotoW = imagesx($photo); 
		$fotoH = imagesy($photo); 
		$logoImage = imagecreatefrompng($srcRank); 
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
		imagettftext($images,17,0,172,72,$color,$font_file,$charname);
		imagettftext($images,17,0,176,122,$color,$font_file,$pos);
		imagettftext($images,10,0,30,300,$color,$font_file,'FB.COM/TIMELINELOL');
		if (!file_exists('images')) {
			mkdir('images', 0777, true);
		}
		$filename= md5(uniqid(mt_rand(), true)).'.jpg';
		$imagesname = 'images/'.$filename;
		imagejpeg($images,$imagesname,100);
		unlink($targetfile);
		$html .='<img class="imgsuccess" src="images/'.$filename.'"/>';
     }
}
echo $html;
?>