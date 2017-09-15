<?php 
ignore_user_abort(true);
require("inc/functions.php");
require("inc/sqlite.php");
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

if(isset($_POST["title"])){
	set_FolderName($_POST["title"]);
}
?>

<html><head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
<title>Info | OpenGallery</title>
<meta name="theme-color" content="<?php echo $color[1]; ?>">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<link rel="icon" type="image/vnd.microsoft.icon" href="inc/media/favicon.ico">
<link rel="icon" type="image/png" href="inc/media/favicon.png">
<link href="inc/css/style.css?v=25" type="text/css" rel="stylesheet">
<style>
	body:before{background-color: <?php echo $color[0]; ?>;}
	a, h3{color:<?php echo $color[0]; ?>;}
	p{margin: .5rem 0;}
	#galleryinfo{width:100%;border:none;margin-top:.5rem}
	#galleryinfo tr{max-width:100%;}
	#galleryinfo tr:nth-of-type(odd){background:#f5f5f5;}
	#galleryinfo td{padding: 5px 10px;width:50%;}
	//#galleryinfo td:first-of-type{color:<?php echo $color[0]; ?>;}
</style>

<style>
	.box h3{text-align:left;}
	body:before{background-color: <?php echo $color[0]; ?>;}
	a, h2{color:<?php echo $color[0]; ?>;}
	button.submit{border: 3px solid <?php echo $color[0]; ?>; color:<?php echo $color[0]; ?>;}
	button.submit:after{background: <?php echo $color[0]; ?>;}
	input#title{border:none;border-bottom: 3px solid <?php echo $color[0]; ?>;}
	input:focus{border-bottom: 3px solid <?php echo $color[0]; ?>;}
	
</style>
</head><body id="body">

<?php include("inc/html/nav.php"); ?>

<?php // End-Header ?>

	
<?php /*
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
*/ ?>


	</head><body id="body">
	<div class="box" style="font-size:1.25rem;">
		<form autocomplete="off" method="POST">
			<h2>Edit Gallery</h2>
			<p style="text-align:left;">Enter a new title:</p>
			<input id="title" name="title" type="text" class="fullinput" placeholder="<?php echo get_FolderName();?>">
			<button name="submit" type="submit" class="submit fullinput">Update</button>
		</form>
		<h2>Gallery Info</h2>
		<table id="galleryinfo">
			<tr><td>Used Storage</td><td><?php echo formatsize(get_foldersize());?></td></tr>
			<tr><td>Items</td><td><?php echo get_countitems();?></td></tr>
			<tr><td>Last Upload</td><td><?php echo date("d.m.Y",get_lastUp()); ?></td></tr>
			<tr><td>Last Zip creation</td><td><?php echo date("d.m.Y",get_lastZip()); ?></td></tr>
			<tr><td>GalleryID</td><td><a href="index.php?a=<?php echo str_replace("u/", "", $album); ?>"><?php echo str_replace("u/", "", $album); ?></a></td></tr>
		</table>
	</div>
	<?php

include("inc/html/footer.php");
?>