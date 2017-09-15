<?php 
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
?>
<html><head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
<title>Create | OpenGallery</title>
<meta name="theme-color" content="<?php echo $color[1]; ?>">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<link rel="icon" type="image/vnd.microsoft.icon" href="inc/media/favicon.ico">
<link rel="icon" type="image/png" href="inc/media/favicon.png">
<link href="inc/css/style.css?v=25" type="text/css" rel="stylesheet">
<?php
if(isset($_POST["title"])){
	$album="";
	require("inc/sqlite.php");
	$galleryid = create_gallery($_POST["title"]);

	?>
	<style>
		body:before{background-color: <?php echo $color[0]; ?>;}
		a, h3{color:<?php echo $color[0]; ?>;}
		p{margin: .5rem 0;}
	</style>
	</head><body id="body">
	
	<?php include("inc/html/nav.php"); ?>
	
	<?php // End-Header ?>

	<div class="box" style="font-size:1.25rem;">
		<p>Please save this ID anywhere!<p>
		<p>We can't restore this! If you lose it, all your files are lost!<p>
		<p><b>LOST FOREVER!</b><p>
		<h3 style="font-size:1.75rem;"><span style="color:#aaa;">ID: </span><?php echo $galleryid; ?></h3>
		<hr style="margin:2rem 1rem;">
		<p>And here is the Link to Share this Gallery with your friends</p>
		<h3 style="font-size:1.75rem;"><a href="https://gallery.hackedit.de/?a=<?php echo $galleryid; ?>">https://gallery.hackedit.de/?a=<?php echo $galleryid; ?></a></h3>
		</br>
	</div>
	
	
<?php }else{ ?>
	<style>
		body:before{background-color: <?php echo $color[0]; ?>;}
		a, h2{color:<?php echo $color[0]; ?>;}
		button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
		button.submit:after{background: <?php echo $color[0]; ?>;}
		input#title{border:none;border-bottom: 3px solid <?php echo $color[0]; ?>;}
		input:focus{border-bottom: 3px solid <?php echo $color[0]; ?>;}
		
	</style>
	</head><body id="body">
	<div class="box" style="font-size:1.25rem;">
		<form autocomplete="off" method="POST">
			<h2 style="text-decoration:underline;">Gallerytitle</h2>
			<p>Enter a title for your new Gallery</p>
			<input id="title" name="title" type="text" class="fullinput" placeholder="My Summer Trip">
			<button name="submit" type="submit" class="submit fullinput">Submit</button>
		</form>
	</div>
	<?php
}
include("inc/html/footer.php");
?>