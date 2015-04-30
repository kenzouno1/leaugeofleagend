<!DOCTYPE html>
<html lang="">
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
<?php
// session_start();
// require_once( 'facebook-php-sdk-v4-4.0-dev/autoload.php' );

// use Facebook\HttpClients\FacebookHttpable;
// use Facebook\HttpClients\FacebookCurl;
// use Facebook\HttpClients\FacebookCurlHttpClient;

// use Facebook\Entities\AccessToken;
// use Facebook\Entities\SignedRequest;

// use Facebook\FacebookSession;
// use Facebook\FacebookRedirectLoginHelper;
// use Facebook\FacebookSignedRequestFromInputHelper; // added in v4.0.9
// use Facebook\FacebookRequest;
// use Facebook\FacebookResponse;
// use Facebook\FacebookSDKException;
// use Facebook\FacebookRequestException;
// use Facebook\FacebookOtherException;
// use Facebook\FacebookAuthorizationException;
// use Facebook\GraphObject;
// use Facebook\GraphSessionInfo;

// // these two classes required for canvas and tab apps
// use Facebook\FacebookCanvasLoginHelper;
// use Facebook\FacebookPageTabHelper;
// $redirect = 'https://www.facebook.com/timelinelol/app_466277736881326';

// FacebookSession::setDefaultApplication('466277736881326','427964af9cc9d9a2908f3dfd261ff1d0');
// $helper = new FacebookRedirectLoginHelper(  $redirect);
// $pageHelper = new FacebookPageTabHelper();

// // get session from the page
// $session = $pageHelper->getSession();

// // see if we have a session
// if ( !isset( $session ) ) {
//   echo '<a href="' . $helper->getLoginUrl( array( 'email', 'user_friends' ) ) . '" target="_top">Login</a>';
  
// } else {
  
//   // graph api request for user data
//   $request = new FacebookRequest( $session, 'GET', '/me' );
//   $response = $request->execute();
//   // get response
//   $graphObject = $response->getGraphObject()->asArray();
  



// // see if we have a session
//   if ( isset( $session ) ) {
    
//     // show logged-in user id
//     echo 'User Id: ' . $pageHelper->getUserId();
    
//     // graph api request for user data
//     $request = new FacebookRequest( $session, 'GET', '/me' );
//     $response = $request->execute();
//     // get response
//     $graphObject = $response->getGraphObject()->asArray();
    
//     // print profile data
//     echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
    
//     // print logout url, target = _top to break out of page frame
//     echo '<a href="' . $helper->getLogoutUrl( $session, 'http://sites.local/php-sdk-4.0/redirect.php' ) . '" target="_top">Logout</a>';
    
//   } else {
//     // show login url, target = _top to break out of page frame
//     echo '<a href="' . $helper->getLoginUrl( array( 'publish_actions' ) ) . '" target="_top">Login</a>';
//   }


?>


<body>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  center-box">
            <div class="jumbotron">
                <div class="container">
                    <div class="center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form>
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
                                            <button id="submit" type="button" name="create" class="btn btn-primary">Tạo Cover</button>
                                        </div>
                                    </div>
                                </fieldset>
                                <input type="hidden" name="img-src" value=""/>
                            </form>
                           
                        </div>
                   
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
        <!-- jQuery -->
    <script src="script/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="script/bootstrap.min.js"></script>
    <script src="script/script.js"></script>
    <script src="script/ajax.js"></script>
     <?php include 'template/modal.php';
    // }
    ?>
    </body>

</html>
   

