<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<?php 
require("inc/functions.php");
require("inc/sqlite.php");
//$colors[ ord(substr($album, 0))%sizeof($colors)];

include("inc/html/header.php");
?>
<style>
body:before{background-color: <?php echo $color[0]; ?>;}
button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
button.submit:after{background: <?php echo $color[0]; ?>;}
.input input[type="email"]:focus{border-color: <?php echo $color[0]; ?>;}
.mailOpt input:focus{border-bottom: 3px solid <?php echo $color[0]; ?>;}
</style>
</head><body id="body">

<?php // Header 
include("inc/html/nav.php");
// End-Header ?>
<?php // Main 

?>
<div class="main box">
	<form class="mailOpt" action="mail-handle.php?update" autocomplete="on" method="POST">
		<input type="text" name="id" hidden style="display:none;" value="<?php echo $id; ?>">
		<label for="name">Enter your Name so we can write more personal mails to you</label>
		<input type="text" name="name" placeholder="Adrian Jost" value="<?php echo get_username($id);?>">
		</br>
		<button type="submit" class="submit">Update</button>
	</form>
	<form class="mailOpt" action="mail-handle.php?delete" autocomplete="on" method="POST">
		<label>You aren't happy? We can unsubscribe you from this mailing-list</label>
		<input type="text" name="id" hidden style="display:none;" value="<?php echo $id; ?>">
		<button type="submit" class="submit">Delete Me (<?php echo get_usermail($id);?>)</button>
	</form>
</div>
<?php // End-Main 
include("inc/html/footer.php");?>