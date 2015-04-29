<!DOCTYPE html>
<html lang="">
<?php
include 'function/function.php';
$func = new FunctionCode();
 $msg = array();
 $success = '';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $img = '';
     if (!isset($_POST['charname'])||empty($_POST['charname'])) {
         $msg[] = 'Bạn chưa nhập tên nhân vật';
     }
      elseif (!isset($_POST['pos'])||empty($_POST['pos'])) {
         $msg[] = 'Bạn chưa nhập vị trí VD : Top';
    } 
     elseif (!isset($_POST['img-src'])||empty($_POST['img-src'])) {
       $msg[] = 'Bạn phải chọn hoặc tải 1 hình ảnh để làm ảnh nền.';  
     }else{
        $charname = $_POST['charname'];
        $pos = $_POST['pos'];
        $imgsrc = $_POST['img-src'];
        $rank =$_POST['rank'];
        $srcRank = 'img/rank/'.$rank;
        $success = $func->createImage($srcRank,$imgsrc,$charname,$pos);

    
     }
}

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>
    <!-- Bootstrap CSS -->
    <link href="reset.css" rel="stylesheet">
    <link href="style/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  center-box">
            <div class="jumbotron">
                <div class="container">
                    <div class="center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form method="post" action="index.php" class="form-horizontal">
                                <fieldset>
                                    <!-- Form Name -->
                                    <legend>Tạo Timeline LOL</legend>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="charname">Tên Nhân Vật</label>
                                        <div class="col-md-6">
                                            <input id="charname" name="charname" type="text" placeholder="Tên Nhân Vật" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="pos">Vị trí</label>
                                        <div class="col-md-6">
                                            <input id="pos" name="pos" type="text" placeholder="Jungle,Top,Mid,Ad Carry,Sp" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="rank">Rank</label>
                                        <div class="col-md-6">
                                            <select id="rank" name="rank" class="form-control">
                                                <option value="all.png">Tổng hợp</option>
                                                <option value="silver.png">Bạc</option>
                                                <option value="gold.png">Vàng</option>
                                                <option value="bk.png">Bạch Kim</option>
                                                <option value="diamond.png">Kim Cương</option>
                                                <option value="war.png">Thách Đấu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- File Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="chmp">Chọn ảnh</label>
                                        <div data-toggle="modal" data-target=".bs-example-modal-lg" class="col-md-12 selectimg panel text-center">
                                            <img src='image/select.png' />
                                            <p> Nhấn vào đây để chọn ảnh nền</p>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for=""></label>
                                        <div class="col-md-4">
                                            <button id="submit" type="submit" name="create" class="btn btn-primary">Tạo Cover</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <input type="hidden" name="img-src" value=""/>
                            </form>
                           
                        </div>
                   
                    </div>
                      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <?php if ($success !='') {
                                        echo '<img src="'.$success.'" class="imgsuccess">';
                                } ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include 'template/modal.php';?>
    <!-- jQuery -->
    <script src="script/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="script/bootstrap.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/ajax.js"></script>
</body>

</html>
