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
	if ($id=="ERROR"){
		$_SESSION["mailstatus"] = "duplicate";
		header("Location: index.php"); 
		exit();
	}
	include("inc/mails/mail-subscribe.php");
	smail($email,"OpenGallery: Please Confirm Subscription",$text);
	$_SESSION["mailstatus"] = "newabo";
	header("Location: index.php");
}
elseif(isset($_GET['subscribe'])){
	// change status to 1
	$id = $_GET["subscribe"];	
	enable_user($id);
	$_SESSION["mailstatus"] = "subscribed";
	header("Location: mail.php");
}
elseif(isset($_GET['update']) && $_SERVER['REQUEST_METHOD'] == 'POST'){	
	// update users name
	update_username($_POST["id"], strip( $_POST["name"]	));
	$_SESSION["mailstatus"] = "updated";
	header("Location: index.php");
}
elseif(isset($_GET['delete']) && $_SERVER['REQUEST_METHOD'] == 'POST'){	
	// delete users
	delete_user($_POST["id"]);
	$_SESSION["mailstatus"] = "deleted";
	header("Location: index.php");
}


//send mail
function smail($to,$sub,$text){
	$headers  = "From: OpenGallery <noreply@gallery.hackedit.de>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	return mail($to,$sub,wordwrap($text),$headers);
}
?>
