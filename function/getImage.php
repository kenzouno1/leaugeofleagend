<?php
include 'function.php';
$func      = new FunctionCode();
$data      = '';
$currentDir = 'img/champ/';
if (isset($_GET['dir'])) {
	$dir = $_GET['dir'];
	$arrFile = $func-> getFile('../'.$dir);
	foreach ($arrFile as $file) {
		if ($file!='avatar.png') {
		
			$data.="<img class='cover' data-dir='".$dir.'/'.$file."' src='".$dir.'/'.$file."' alt='".$file."'/>";
	
		}
	}
}
echo $data;
?>