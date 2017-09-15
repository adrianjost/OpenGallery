<?php 
if(!isset($_GET['a'])){header("HTTP/1.1 403 Forbidden"); header("Location: upload.php"); exit();}
$album = "u/".$_GET['a'];

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
	array("#FF5722", "##BF360C")
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

// filesizeformat
function formatsize($bytes){
	if 	($bytes >= 1048576)		{$bytes = number_format($bytes / 1048576, 2) . ' MB';}
	elseif 	($bytes >= 1024)		{$bytes = number_format($bytes / 1024, 2) . ' KB';}
	elseif 	($bytes > 1)			{$bytes = $bytes . ' bytes';}
	elseif 	($bytes == 1)			{$bytes = $bytes . ' byte';}
	else							{$bytes = '0 bytes';}
	return $bytes;
}
?>