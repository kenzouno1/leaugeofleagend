<?php
include 'function.php';
$func      = new FunctionCode();
$data      = '';

if (isset($_GET['dir'])) {
	$dir = $_GET['dir'];
	$arrFile = $func-> getFile('../'.$dir);
	foreach ($arrFile as $file) {
		if ($file!='avatar.png') {

		$data.="<div class='cover'>";
		$data.="<img src='".$dir."/".$file."' alt='".$file."'>";
		$data.="</div>";
		}
	}
}
echo $data;
?>