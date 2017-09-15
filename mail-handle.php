<?php 
require("inc/functions.php");
require("inc/sqlite.php");
// ID | Name | E-Mail | status (0/1)

function strip($data) { return htmlspecialchars(stripslashes(trim($data)));	}
function ismail($data){return(strpos($data, '@') !== false) ? true:false;}
function isvalid($data){return ($data=="") ? false:true;}
if(isset($_GET['new']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	//create new user
	$email = $_POST["email"];
	if (!ismail($email)){exit();}
	$id = create_user(strip($email));
	if ($id=="ERROR"){header("Location: https://gallery.hackedit.de/?a=$album&frommail&duplicate");exit();}
	include("inc/mails/mail-subscribe.php");
	smail($email,"OpenGallery: Please Confirm Subscription",$text);
	header("Location: https://gallery.hackedit.de/?a=$album&frommail&newabo");
}
elseif(isset($_GET['subscribe'])){
	// change status to 1
	$id = $_GET["subscribe"];	
	enable_user($id);
	header("Location: https://gallery.hackedit.de/mail.php?a=$album&id=$id&frommail&subscribed");
}
elseif(isset($_GET['update']) && $_SERVER['REQUEST_METHOD'] == 'POST'){	
	// update users name
	update_username($_POST["id"], strip( $_POST["name"]	));
	header("Location: https://gallery.hackedit.de/?a=$album&frommail&updated");
}
elseif(isset($_GET['delete']) && $_SERVER['REQUEST_METHOD'] == 'POST'){	
	// delete users
	delete_user($_POST["id"]);
	header("Location: https://gallery.hackedit.de/?a=$album&frommail&deleted");
}


//send mail
function smail($to,$sub,$text){
	$headers  = "From: OpenGallery <noreply@gallery.hackedit.de>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	return mail($to,$sub,wordwrap($text),$headers);
}
?>
