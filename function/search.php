
<?php
include 'function.php';
$func      = new FunctionCode();
$imagesDir = '../img/champ/';
$data      = '';
$arrName   = $func->getFodel($imagesDir);
if (isset($_POST['txtsearch']) && !empty($_POST['txtsearch'])) {
    $search = $_POST['txtsearch'];
    for ($i = 0; $i < count($arrName); $i++) {
        $name = strtolower($arrName[$i]);
        if (strpos($name, $search) !== false) {
          $dir = 'img/champ/'.$name;
            $data .= '<div id="' . $arrName[$i] . '" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <img id="img-champ" data-dir='.$dir.'  src="img/champ/' . $arrName[$i] . '/avatar.png" alt="' . $arrName[$i] . '">
                    </div>';
        }
    }
} else {
    for ($i = 0; $i < count($arrName); $i++) {
         $dir = 'img/champ/'.$arrName[$i];
        $data .= '<div id="' . $arrName[$i] . '" class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <img id="img-champ" data-dir='.$dir.'  src="img/champ/' . $arrName[$i] . '/avatar.png" alt="' . $arrName[$i] . '">
                        </div>';
    }
}
echo $data;
?>