<?php if($_GET['a']=="abifahrt2"){header("Location: index.php?a=abifahrt");exit();}?>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<html><head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=false">
<script defer src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script defer src="jquery.lazyload.min.js?v3"></script>
<style>
html,body,h1,h2,h3,h4,h5,p,a{margin:0;padding:0; font-family: "Segoe UI", Arial;}
.body{position:relative; -webkit-text-size-adjust: 100%; line-height: initial; background: #000 url("https://source.unsplash.com/collection/242611") no-repeat center; background-size: cover;}
body{position:relative; line-height: initial; background: #2196F3;}
a{color:#2196F3; text-decoration: none;}
ul,li{list-style: none;padding-left: .5rem;margin:0;}

.header{ display: inline-block; position: fixed; top: 0; left:0; z-index: 9999; width:100%; background: #fff; border-bottom: 1px #ccc solid;}
.header::after{content=" "; clear:both;}
.title{float: left; padding: .25rem .5rem .25rem 1rem;}
.back{display: inline-block;width:1.5rem; height:1.5rem;}
.headline{display: inline-block; color:#2196F3;font-size: 2rem;line-height: 2.5rem;}
.headline span{text-transform:capitalize; font-size:1rem; color:#999;}
.header .button{float:right; margin: .5rem .25rem;}
.header .button a{display: block;padding: .5rem; background: #2196F3; color: #fff; border-radius: 5px; font-weight: 300; text-decoration: none; font-size: 1rem; line-height: 1.5rem;}

.main{
	max-width: 1000px;
	margin: 4rem auto 2rem;
	text-align: center;
}
.imgwrap{
	position:relative;
	max-width: 300px;
	margin: 10px;
	display: inline-block;
	vertical-align: middle;
	
    max-height: 169px;
    overflow: hidden;
}
.imgwrap video{
	max-height:169px;
	max-height:300px;
}
.imgwrap img{
	max-width: 100%;
	height: auto;
}
.imgwrap .delete{
	position: absolute;
	display:none;
	top: 10px;
	right: 10px;
	z-index: 9999;
}
.imgwrap .delete svg{
	width: 0; 
	height: 0;
	opacity: .9;
}
.imgwrap:hover .delete{
	display:initial;
}
.imgwrap:hover .delete svg{
	width: 25px; 
	height: 25px;
}
.imgwrap .filename{
	position: absolute;
	display:none;
	top: 0; left: 0;
	overflow: hidden;
	color: #fff;
	text-align: left;
	font-size:.6rem;
	text-shadow: 0 0 10px #000;
	padding:5px;
}
.imgwrap:hover .filename{
	display:block;
}

.imgwrap.full{
	position: fixed;
    top: 0;
    left: 0;
    z-index: 99999;
    width: 100%;
    height: 100%;
    display: inline-block;
    max-width: 100%;
    max-height: 100%;
    background: rgba(0,0,0,.9);
    margin: 0;
}
.imgwrap.full:before{
	content:"✕";
	color:#fff;
	position: absolute;
	top:0; right:0;
	padding:5px;
	font-size:1.5rem;
	line-height:1.2rem;
}
.imgwrap.full img{    
	display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
	   -moz-transform: translate(-50%, -50%);
		-ms-transform: translate(-50, -50);
		 -o-transform: translate(-50, -50);
			transform: translate(-50, -50);
	width:auto;
	height: auto;
	max-width: 95%;
	max-height:95%;
}

svg{
	display: inline-block;
    vertical-align: bottom;
    height: 1.2rem;
}

.lazy {
    display: none;
}
.delete{float:right;}
.delete svg{width:1.25rem; height:1.25rem;}
.delete:hover svg path{fill:#900;}

@media (max-width: 600px){
	.header{position: relative;}
	.title,	.header .button{float:none; text-align: center;}
	.main{padding: 1rem; margin: 1rem auto 1rem}
	.imgwrap{max-width: 45%; margin:5px; }
	.imgwrap.video{max-width:95%;}
} 
</style>
</head><body id="body">

<?php // Header ?>
<?php $album = $_GET['a']; 
function isimg($fname){
	$urlExt = pathinfo($fname, PATHINFO_EXTENSION);
	if (in_array($urlExt, array("gif", "jpg", "jpeg", "png"))) {return True;}
	else{ return False; }
}
?>
<div class="header">
	<div class="title">
		<h1 class="headline">Gallery<span id="albumname">~<?php echo $album; ?></span></h1>
	</div>
	<div class="button"><a href="upload.php?a=<?php echo $album; ?>">
		<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
		Add File</a></div>
	<div class="button"><a target="_blank" href="download.php?a=<?php echo $album; ?>">
		<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"/><path d="M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z"/></g></svg>
		Download</a></div>
</div>
<?php // End-Header ?>
<?php // Backups ?>

<div class="main">

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
			<video <?php if(!$ismobile){ echo "data-src"; }else{echo"src";}?>="<?php echo $file; ?>" width="300px" height="170px" class="lazyvid" controls <?php if(!$ismobile){ ?>poster="loadvideo.jpg" onclick="var sourceFile = $(this).attr('data-src');$(this).attr('src', sourceFile);$(this).load();" <?php } ?>>
				Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.
			</video>
			<noscript><video src="<?php echo $file; ?>" controls>Ihr Browser kann dieses Video nicht wiedergeben.<br>Sie können das Video <a href="<?php echo $file; ?>">hier</a> abrufen.</video></noscript>
		<?php } ?>
	</div>
<?php } ?>



</div>
<?php // End-Backups ?>
<p style="text-align:center;color:#fff;padding:5px;font-size:.6rem;">&copy; Copyright <a href="https://adrianjost.hackedit.de" rel="nofollow" style="color:#fff";>Adrian Jost</a></p>
</body></html>