<?php if($_GET['a']=="abifahrt2"){header("Location: index.php?a=abifahrt");exit();}?>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<?php 
// mobile detection
if (preg_match('@(iPod|iPhone|Android|Mobil|BlackBerry|Windows Phone|SymbianOS|Opera Mini|Nokia|SonyEricsson)@', $_SERVER['HTTP_USER_AGENT'])){$res = 150; $ismobile=true;}
else{$res = 300;$ismobile=false;}

// filesizeformat
function formatsize($bytes){
	if 	($bytes >= 1048576)		{$bytes = number_format($bytes / 1048576, 2) . ' MB';}
	elseif 	($bytes >= 1024)		{$bytes = number_format($bytes / 1024, 2) . ' KB';}
	elseif 	($bytes > 1)			{$bytes = $bytes . ' bytes';}
	elseif 	($bytes == 1)			{$bytes = $bytes . ' byte';}
	else							{$bytes = '0 bytes';}
	return $bytes;
}
function isimg($fname){
	$urlExt = pathinfo($fname, PATHINFO_EXTENSION);
	if (in_array($urlExt, array("gif", "jpg", "jpeg", "png"))) {return True;}
	else{ return False; }
}
$album = $_GET['a'];
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
//$colors[ ord(substr($album, 0))%sizeof($colors)];

?>
<html><head>
<title>Gallery ~ <?php echo $album; ?></title>
<link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<script defer src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script defer src="jquery.lazyload.min.js?v3"></script>
<meta name="theme-color" content="<?php echo $color[1]; ?>">
<link rel="stylesheet" href="style.css?v=23" type="text/css" media="all">
<style>
body:before{background-color: <?php echo $color[0]; ?>;}
a{color:<?php echo $color[0]; ?>;}
.main{max-width: 1000px;margin: 5rem auto 1rem;padding:.5rem 0;}
</style>
</head><body id="body">

<?php // Header ?>
<nav id="navigation">
	<div class="title">
		<a href="/?a=<?php echo $album; ?>">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 1800"><path d="M932.14 845.75q0-14.05-9.04-23.1-9.04-9.03-23.1-9.03-66.3 0-113.5 47.2-47.2 47.17-47.2 113.43 0 14.05 9.03 23.1 9.04 9.02 23.1 9.02 14.06 0 23.1-9.03 9.04-9.04 9.04-23.1 0-40.15 28.13-68.26 28.12-28.1 68.3-28.1 14.06 0 23.1-9.04 9.04-9.04 9.04-23.1zm225 130.5q0 106.42-75.33 181.7-75.32 75.3-181.8 75.3-106.46 0-181.8-75.3-75.33-75.28-75.33-181.7 0-106.4 75.33-181.7 75.33-75.3 181.8-75.3 106.47 0 181.8 75.3 75.34 75.3 75.34 181.7zM128.57 1552.5h1542.86V1424H128.57v128.5zM1285.7 976.26q0-159.62-113-272.56T900 590.76q-159.7 0-272.7 112.94t-113 272.56q0 159.62 113 272.56T900 1361.76q159.7 0 272.7-112.94t113-272.56zM257.15 331.76h385.72v-128.5H257.14v128.5zM128.57 524.5h1542.86v-257h-831.7L775.45 396H128.57v128.5zM1800 267.5v1285q0 53.2-37.67 90.85-37.66 37.65-90.9 37.65H128.57q-53.24 0-90.9-37.65Q0 1605.7 0 1552.5v-1285q0-53.2 37.67-90.85Q75.33 139 128.57 139h1542.86q53.24 0 90.9 37.65Q1800 214.3 1800 267.5z" fill="#fff"/></svg>
			Galerie<span id="albumname"> <?php echo $album; ?></span>
		</a>
	</div>
	<div id="navtoggle" class="navtoggle"><a href="javascript:document.getElementById('navigation').classList.toggle('open');">&#9776;</a></div>
	<div id="sitenavigation" class="navigation">
		<ul>
			<li><a href="upload.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
				Upload</a></li>
			<li><a href="download.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"/><path d="M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z"/></g></svg>
				Download</a></li>
			<li><a target="_blank" href="https://hackedit.de/contact">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 1792 1792"><path d="M1664 1504V736q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5T897 1280h-2q-48 0-102.5-24.5T706 1207t-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5H160q-13 0-22.5 9.5T128 416q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5T852 1143t43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5T1664 453zm128-37v1088q0 66-47 113t-113 47H160q-66 0-113-47T0 1504V416q0-66 47-113t113-47h1472q66 0 113 47t47 113z"/></svg>
				Feedback</a></li>
		</ul>
	</div>
</nav>
<?php // End-Header ?>
<?php // Backups ?>

<div class="main">
<h2 id="albumname"><?php echo $album; ?></h2>
<?php 
$files = glob("$album/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE);
rsort($files);
foreach ($files as $file) {
?>
	<div class="imgwrap <?php if(!isimg($file)){echo "video";} ?>" <?php if(isimg($file)){ ?> onclick="$(this).toggleClass('full');if($(this).hasClass('full')){var image = $('.imgwrap.full > img');image.attr('src', image.attr('data-original').replace('?r=<?php echo $res; ?>',''));}" <?php } ?>>
		<?php if (isset($_GET['admin'])){ // Delete Button?>
			<a class="delete" href="delete.php?a=<?php echo $album; ?>&file=<?php echo $file; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#ea4335" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path></svg>
			</a>
		<?php } ?>
		<span class="filename"><?php echo str_replace($_GET['a']."/","", $file); ?></br><?php echo formatsize(filesize($file)); ?></span>
		<?php if(isimg($file)){ // Image files?>
				<img data-original="<?php echo $file; ?>?r=<?php echo $res; ?>" class="lazy" width="300px" height="170px">
				<noscript><img src="<?php echo $file; ?>?r=<?php echo $res; ?>"></noscript>
		<?php } else { // Video files?>
			<?php /* /<video data-src="<?php echo $file; ?>" class="lazy" width="300px" height="170px" controls autobuffer >Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.</video> */ ?>
			<video <?php if(!$ismobile){ echo "data-src"; }else{echo"src";}?>="<?php echo $file; ?>" width="300px" height="170px" class="lazyvid" controls <?php if(!$ismobile){ ?>poster="loadvideo.jpg" onclick="var sourceFile = $(this).attr('data-src');$(this).attr('src', sourceFile);$(this).removeAttr('data-src');$(this).load();$(this).removeAttr('poster');" <?php } ?>>
				Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.
			</video>
			<noscript><video src="<?php echo $file; ?>" controls>Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.</video></noscript>
		<?php } ?>
	</div>
<?php } ?>

</div>
<?php // End-Backups ?>
<p style="text-align:center;color:#555;padding:5px;font-size:.6rem;">&copy; Copyright <a href="https://adrianjost.hackedit.de" rel="nofollow" style="color:#000";>Adrian Jost</a></p>
</body></html>