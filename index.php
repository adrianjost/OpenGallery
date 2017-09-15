<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<?php 
require("inc/functions.php");
require("inc/sqlite.php");

include("inc/html/head.php");
?>
<style>
body:before{background-color: <?php echo $color[0]; ?>;}
a{color:<?php echo $color[0]; ?>;}
.main{max-width: 1000px;padding:.5rem 0;}
button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
button.submit:after{background: <?php echo $color[0]; ?>;}
.input input[type="email"]:focus{border-color: <?php echo $color[0]; ?>;}
.main .bt{background-color: <?php echo $color[0]; ?>;}
</style>
<?php
 //<script defer src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
 //<script defer src="inc/jquery.lazyload.min.js?v3"></script> ?>
 <script>var minsize="?r=<?php echo ($ismobile)?"150":"300" ?>",maxsize="?r=<?php echo ($ismobile)?"500":"1000"?>"; <?php if (isset($_GET['admin'])){?>
function loadEXT(a,b){var c=new XMLHttpRequest;c.open("GET",a,!0),c.onreadystatechange=function(){4==c.readyState&&"200"==c.status?b(c.responseText):4==c.readyState&&b("noresponse")},c.send(null)}
function dph(e,n){
	loadEXT("https://gallery.hackedit.de/delete.php?a=<?php echo $album; ?>&file="+n,function(){});
	e.parentNode.removeChild(e)}
<?php } ?></script>
<script defer src="inc/js/script.min.js?v6"></script>
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
				<label for="q1">Get notified on new uploads <b>(BETA)</b>. Enter your Mail:</label>
				<input type="email" id="q1" name="email" placeholder="youremail@example.com" required>
			</div>
			<button type="submit" class="submit">Submit</button>
		</form>
	<?php }else{
		echo "<p style='display:block;padding:.5rem;font-size:1.2rem;'>";
		if(		$_SESSION["mailstatus"] == "newabo") 	{echo "We've send you an e-mail. Please confirm your mail by clicking the link in the mail.";}
		elseif(	$_SESSION["mailstatus"] == "updated") 	{echo "We've updated your username. Thanks!";}
		elseif(	$_SESSION["mailstatus"] == "deleted") 	{echo "We've deleted all information we had about you.";}
		elseif(	$_SESSION["mailstatus"] == "duplicate") {echo "You are already an follower! But we send you an link where you can check everything ;)";}		
		unset($_SESSION["mailstatus"]);
		echo "</p>";
	} ?>
</div>
<div class="main box">
<h2 id="albumname"><?php echo get_FolderName(); ?></h2>
<?php 
$count = 0;
$files = glob("$album/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE);
rsort($files);
foreach ($files as $file) {
?>
	<div class="imgwrap <?php if(!isimg($file)){echo "video";}else{echo "image";} ?>">
		<?php if (isset($_GET['admin'])){ // Delete Button?>
			<a class="delete" onclick="dph(this.parentNode,'<?php echo $file; ?>');">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ea4335" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path></svg>
			</a>
		<?php } ?>
		<span class="filename"><?php echo str_replace($album."/","", $file); ?></br><?php echo formatsize(filesize($file)); ?></span>
		
		
		
		<?php if(isimg($file)){ // Image files ?>
				<?php $tmpimg=$file."?r=".$res; 
				if ($count <= 12){
				?>
					<img data-original="<?php echo $tmpimg; ?>" src="<?php echo $tmpimg; ?>" 
					class="lazy" width="300px" height="170px" tabindex="0">
				<?php } else { // Video files?>
					<img data-original="<?php echo $tmpimg; ?>" 
					class="lazy" width="300px" height="170px" tabindex="0">
				<?php } ?>
		<?php } else { // Video files?>
			<video <?php if(!$ismobile){ echo "data-src"; }else{echo"src";}?>="<?php echo $file; ?>" tabindex="0" width="300px" height="170px" class="lazyvid" controls <?php if(!$ismobile){ ?>poster="inc/media/loadvideo.jpg"<?php } ?>>
				Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.
			</video>
		<?php } ?>
	</div>
<?php $count = $count + 1;
} 
if($count==0){?>
	<h3>no images found 😢</h3>
	<a class="bt" href="upload.php">
		<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
		upload some</a>
	
<?php } ?>
</div>

<div id="gallerynav" class="gallerynav hidden">
	<a class="galleryprev" id="galleryprev" tabindex="0"><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="46" viewBox="0 0 18 46"><path d="M16.26 1.3L2.28 23l13.98 21.7" opacity=".6" fill="none" stroke="#fff" stroke-width="2.98"/></svg></span></a>
	<a class="gallerynext" id="gallerynext" tabindex="0"><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="46" viewBox="0 0 18 46"><path d="M1.76 1.3L15.74 23 1.76 44.7" opacity=".6" fill="none" stroke="#fff" stroke-width="2.98"/></svg></span></a>
</div>

<script src="inc/js/lazyload.min.js"></script>
<script>new LazyLoad({threshold: 100});</script>
<?php /*<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="inc/js/jquery.lazyload.min.js"></script> */ ?>

<?php include("inc/html/footer.php"); ?>