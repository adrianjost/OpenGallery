<?php 
session_start(); 
if(isset($_GET['a'])){
    $album = "u/".$_GET['a'];
    $_SESSION["album"] = $album;
}
elseif(isset($_SESSION["album"])){
    $album = $_SESSION["album"];
}
//if(!isset($album)){header("HTTP/1.1 403 Forbidden"); exit();}
if(!isset($album) || !is_dir($album)){header("HTTP/1.1 511 Network Authentication Required"); header("Location: authenticate.php"); exit();}
//else{echo $album;}

// durch SQLite Abrage ersetzen
$albumid = str_replace("u/","",$album);


$colors = array(
    array("#F44336", "#B71C1C"),
    array("#E91E63", "#880E4F"),
    array("#3F51B5", "#1A237E"),
    array("#2196F3", "#0D47A1"),
    array("#03A9F4", "#01579B"),
    array("#00BCD4", "#006064"),
    array("#009688", "#004D40"),
    array("#4CAF50", "#1B5E20"),
    array("#8BC34A", "#33691E"),
    array("#CDDC39", "#827717"),
    array("#FFC107", "#FF6F00"),
    array("#FF9800", "#E65100"),
    array("#FF5722", "#BF360C")
);
$color = $colors[ array_rand($colors,1)];

// ########################
// index.php
// ########################

// mobile detection
if (preg_match('@(iPod|iPhone|Android|Mobil|BlackBerry|Windows Phone|SymbianOS|Opera Mini|Nokia|SonyEricsson)@', $_SERVER['HTTP_USER_AGENT'])){$res = 150; $ismobile=true;}
else{$res = 300;$ismobile=false;}

function isimg($fname){
    $urlExt = pathinfo($fname, PATHINFO_EXTENSION);
    if (in_array($urlExt, array("gif", "jpg", "jpeg", "png"))) {return True;}
    else{ return False; }
}

function updatefolder(){
    global $album;
    $s=0;
    $c=0;
    $files = glob("$album/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE|GLOB_NOSORT);
    foreach ($files as $file) {
        $s = $s + filesize($file);
        $c = $c + 1;
    }
    set_foldersize($s);
    set_itemcount($c);
}

// filesizeformat
function formatsize($bytes){
    if     ($bytes >= 1048576)        {$bytes = number_format($bytes / 1048576, 2) . ' MB';}
    elseif     ($bytes >= 1024)        {$bytes = number_format($bytes / 1024, 2) . ' KB';}
    elseif     ($bytes > 1)            {$bytes = $bytes . ' bytes';}
    elseif     ($bytes == 1)            {$bytes = $bytes . ' byte';}
    else                            {$bytes = '0 bytes';}
    return $bytes;
}

?>