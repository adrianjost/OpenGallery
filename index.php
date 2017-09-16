<?php 
    session_start();
    require_once("functions.php");
 ?>
<html>
<head>
    <?php require("static/html/head.php"); ?>
</head>
<body>
    <?php require("static/html/header.php"); ?>
    <main class="clearfix container">
        <div class="card">
            <div class="card-block">
                <?php 
                
                //include
                include('Config.php');
                include('Route.php');
                
                //config
                Config::set('basepath', "gallery" );
                 
                //init routing
                Route::init();

                //base route (startpage)
                Route::add('',function(){
                    //Do something
                    include("pages/index.php");
                });
                
                Route::add('login',function(){
                    //Do something
                    include("pages/login.php");
                });
                
                Route::add('register',function(){
                    //Do something
                    include("pages/register.php");
                });
                
                //gallery route
                Route::add('([a-zA-Z-0-9]{5})',function($uid){
                    //Do something
                    echo 'This is the User-View: </br>UserId: '.$uid;
                });
                
                //gallery route
                Route::add('([a-zA-Z-0-9]{5})([a-zA-Z-0-9]{5})',function($guid, $gid){
                    //Do something
                    echo 'This is the Gallery-View: </br>UserId: '.$uid."</br>GalleryId: ".$gid;
                });
                
                //Add a 404 Not found Route
                Route::add404(function($url){
                    
                    //Send 404 Header
                    echo '404 😞<br/>';
                    echo $url.' not found!';
                 
                });
                 
                Route::run();

                ?>
            </div>
        </div>
    </main>
    <?php require("static/html/footer.php"); ?>
</body>
</html>