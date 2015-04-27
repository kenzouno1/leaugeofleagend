<?php

public function processUpload($file){
	$target_dir = 'temp/';
	$uploadOk= 1;
	$data = array();
	$ext;
 	if ($file["size"] > 1000000) 
 	{
         $uploadOk = 0;
         $data=array('uploadOk'=>0,'msg'=>'Dung lượng ảnh vượt quá mức cho phép');
    }else{
                $temp  = explode(".",$file["name"]);
                $ext=end($temp);
                if($ext != "jpg" && $ext != "png" && $ext != "jpeg"
                && $ext != "gif" ) 
                {
          			$data=array('uploadOk'=>0,'msg'=>'Chỉ được upload ảnh');
            	}
  		}

  		if ($uploadOk!=0) {
			$token = md5(uniqid(mt_rand(), true));
            $newFileName = $token.".".$ext;
            $target_file = $target_dir .$newFileName;
         	if (!move_uploaded_file($_FILES["tmp_name"], $target_file)) 
         	{
	           
            }
  		}
}

?>