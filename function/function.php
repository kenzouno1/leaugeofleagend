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
}
?>