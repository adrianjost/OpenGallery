<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<?php 
require("inc/functions.php");

include("inc/html/head.php");
?>
<script defer src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<?php //<script defer src="inc/jquery.lazyload.min.js?v3"></script> ?>
<script defer src="inc/js/script.js?v5"></script>
<style>
body:before{background-color: <?php echo $color[0]; ?>;}
a{color:<?php echo $color[0]; ?>;}
.main{max-width: 1000px;padding:.5rem 0;}
button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
button.submit:after{background: <?php echo $color[0]; ?>;}
.input input[type="email"]:focus{border-color: <?php echo $color[0]; ?>;}
</style>
</head><body id="body">

<?php include("inc/html/nav.php"); ?>

<?php // End-Header ?>
<?php // Backups ?>
<noscript>
	<div class="noscript box">
		<h2 style="margin:0; padding:1rem;">Sorry, but you need JavaScript to view this site.</h2>
	</div>
</noscript>
<div class="mail box">
	<?php if(!isset($_SESSION["mailstatus"])){ ?>
		<form action="mail-handle.php?new" autocomplete="on" method="POST">
			<div class="input">
				<input type="text" name="name" hidden value="">
				<label for="q1">Get notified on new uploads. Enter your Mail:</label>
				<input type="email" id="q1" name="email" placeholder="youremail@example.com" required>
			</div>
			<button type="submit" class="submit">Submit</button>
		</form>
	<?php }else{
		echo "<p style='display:block;padding:.5rem;font-size:1.2rem;'>";
		if(		$_SESSION["mailstatus"] == "newabo") 	{echo "We've send you an e-mail. Please confirm your mail by clicking the link in the mail.";}
		elseif(	$_SESSION["mailstatus"] == "updated") 	{echo "We've updated your username. Thanks!";}
		elseif(	$_SESSION["mailstatus"] == "deleted") 	{echo "We've deleted all information we had about you.";}
		elseif(	$_SESSION["mailstatus"] == "duplicate") {echo "You are already an follower!";}		
		unset($_SESSION["mailstatus"]);
		echo "</p>";
	} ?>
</div>
<div class="main box">
<h2 id="albumname"><?php echo $albumname; ?></h2>
<?php 
$files = glob("$album/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE);
rsort($files);
foreach ($files as $file) {
?>
	<div class="imgwrap <?php if(!isimg($file)){echo "video";}else{echo "image";} ?>">
		<?php if (isset($_GET['admin'])){ // Delete Button?>
			<a class="delete" href="delete.php?a=<?php echo $album; ?>&file=<?php echo $file; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ea4335" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path></svg>
			</a>
		<?php } ?>
		<span class="filename"><?php echo str_replace($album."/","", $file); ?></br><?php echo formatsize(filesize($file)); ?></span>
		<?php if(isimg($file)){ // Image files ?>
				<img data-original="<?php echo $file; ?>?r=<?php echo $res; ?>" class="lazy" width="300px" height="170px">
		<?php } else { // Video files?>
			<?php /* /<video data-src="<?php echo $file; ?>" class="lazy" width="300px" height="170px" controls autobuffer >Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.</video> */ ?>
			<video <?php if(!$ismobile){ echo "data-src"; }else{echo"src";}?>="<?php echo $file; ?>" width="300px" height="170px" class="lazyvid" controls <?php if(!$ismobile){ ?>poster="inc/media/loadvideo.jpg"<?php } ?>>
				Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.
			</video>
		<?php } ?>
	</div>
<?php } ?>
</div>

<div class="gallerynav hidden">
	<a class="galleryprev"><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="46" viewBox="0 0 18 46"><path d="M16.26 1.3L2.28 23l13.98 21.7" opacity=".6" fill="none" stroke="#fff" stroke-width="2.98"/></svg></span></a>
	<a class="gallerynext"><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="46" viewBox="0 0 18 46"><path d="M1.76 1.3L15.74 23 1.76 44.7" opacity=".6" fill="none" stroke="#fff" stroke-width="2.98"/></svg></span></a>
</div>

<script src="inc/js/lazyload.min.js"></script>
<script>new LazyLoad();</script>

<?php include("inc/html/footer.php"); ?>