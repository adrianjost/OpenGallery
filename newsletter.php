<?php 
ignore_user_abort(true);

$album="";
require("inc/sqlite.php");
include("inc/mails/mail-newitems.php");

$folders = glob("u/*", GLOB_ONLYDIR);
foreach ($folders as $folder) {
	$album = $folder;
	$dbPath = __DIR__."/".$album."/sqlite3.db";
	updatefolder();
	
	echo "</br>".$album." - ".get_FolderName()." (".get_countitems()."|".get_lastNewsItems().")</br>";
	echo "⇒ ".((get_lastNewsTime()<get_lastUp()) ? ("+".get_countitems()-get_lastNewsItems()) : "0") ." new</br>";
	
	if(get_lastNewsTime()<get_lastUp()){		
		$fname = get_FolderName();												// Gallery-name
		$newitems = get_countitems()-get_lastNewsItems();						// Number of new Items
		if ($newitems == 0){$newitems = "some";}
		$link = "https://gallery.hackedit.de/?a=".str_replace("u/","",$folder);	// link to gallery
		
		echo "USER:</br>";
		// user specific data
		$abos = get_users();
		foreach ($abos as $uid){
			$uname = get_username($uid);
			$email = get_usermail($uid);
			echo "\t".$fname.": ".$email."(".$uname.")</br>";
			smail($email,"OpenGallery ($fname): New Files (".$newitems.")",newitemmail($newitems,$fname,$link,$uid,$uname));
		}
		echo "</br></br>";
	}
	set_lastNewsItems();
	set_lastNewsTime();
}


// F U N C T I O N S # # # # # # # # # # # # # # # # # # # # # # # # # # # #

function updatefolder(){
	global $album;
	$s=0; $c=0;
	$files = glob("$album/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE|GLOB_NOSORT);
	foreach ($files as $file) {
		$s = $s + filesize($file);
		$c = $c + 1;
	}
	set_foldersize($s);
	set_itemcount($c);
}

//send mail
function smail($to,$sub,$text){
	$headers  = "From: OpenGallery <noreply@gallery.hackedit.de>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	return mail($to,$sub,wordwrap($text),$headers);
}
?>