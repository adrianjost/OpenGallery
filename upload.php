<?php 
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
//	array("#CDDC39", "#827717"),
//	array("#FFC107", "#FF6F00"),
	array("#FF9800", "#E65100"),
	array("#FF5722", "#BF360C")
);
$color = $colors[ array_rand($colors,1)];
//$colors[ ord(substr($album, 0))%sizeof($colors)];

?>
<html><head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
<title>Gallery ~ <?php echo $album; ?></title>
<link href="dropzone.min.css" type="text/css" rel="stylesheet" />
<meta name="theme-color" content="<?php echo $color[1]; ?>">
<style>
html,body,h1,h2,h3,h4,h5,p,a{margin:0;padding:0; font-family: "Segoe UI", Arial;}
body{position:relative; -webkit-text-size-adjust: 100%; line-height: initial; background: #eee;}
body:before{
	content: "";
	display:block;
	z-index: -1;
    position: fixed;
    width: 100%;
    height: 40vh;
    top: 0;
    background-color: <?php echo $color[0]; ?>;
}
a{color:<?php echo $color[0]; ?>; text-decoration: none;}
ul,li{padding:0;margin:0;}

/* Navigationbar */
nav{position:fixed; top: 0; left:0;z-index:9999;width: 100%;min-height: 3rem;background: rgba(0,0,0,.5);}
nav a{color:#fff;}
nav .title a{float: left;padding: .5rem .5rem 0;font: 400 2rem Sans-Serif;}
nav .title a svg{display: inline-block;width:1.5rem; height:1.5rem;}
nav .title a span{text-transform:capitalize; font-size:.8rem; color:rgba(255,255,255,.5);}
nav .navigation{float: right;}
nav li{display:inline-block; float:left;text-align:center;}
nav li a{display:inline-block;padding: 1rem;max-width:200px;}
nav li a svg{display:inline; height: 1rem; width:auto; }
nav ul{margin-right:1rem;}
nav ul li:hover{background: rgba(255,255,255,.5);}
#navtoggle{display:none; float:right; padding: .5rem 1rem; font-size:1.5rem; transition: all .3s ease-in-out;}
nav.open #navtoggle{color: #aaa;-webkit-transform: rotate(270deg);-moz-transform: rotate(270deg);-ms-transform: rotate(270deg);-o-transform: rotate(270deg);filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);}

.main{
	box-sizing: border-box;
	width: 95%;
	max-width: 800px;
	text-align: center;
	background-color: #fff;
    border-radius: 3px;
    box-shadow: 0 2px 7px 0 rgba(0, 0, 0, 0.19), 0 2px 6px 0 rgba(0, 0, 0, 0.2);
    margin: 7.5rem auto 1rem;
	padding: 2rem;
}
.dropzone {
    border: 2px dashed <?php echo $color[0]; ?>;
    border-radius: 5px;
    background: white;
	margin:2rem;
}
.dropzone .dz-message { font-size:1.2rem; font-weight:700; color:<?php echo $color[0]; ?>;}
.dropzone .dz-message span{ font-size:.8rem; font-weight:400; color:#999;}

.hidden{display:none;}

.main input{display:inline-block;}
.noscriptform{margin:2rem 0;}
.noscriptform input{margin: 1rem 0;}
.main input[type="submit"] {display: none;}
.main #Lsubmitimg{
	position: relative;
	display: inline-block;
    overflow: hidden;
	cursor: pointer;
	max-width: 200px;
	font-weight: 700;
    margin: 20px 0;
    padding: 10px;
    background: <?php echo $color[0]; ?>;
	color: #fff;
    border: none;
}
.main #Lsubmitimg svg{
	position: relative;
	display: inline-block;
	vertical-align: bottom;
	height: 1.2rem;
}

@media (max-width: 600px){
	body:before{height: 60vh;}
	
	nav .navigation{float: left;margin: 0; width:100%;}
	nav .title a{border-bottom: 1px solid rgba(255,255,255,.5);}
	nav ul{margin: 0; width:100%;}
	nav li{min-width: 50%;}
	nav li a{padding: .75rem 0;}
	nav #navtoggle{display:block;}
	nav .navigation li{		max-height: 0;		opacity:0;	transition: all .3s ease-in-out; }
	nav.open .navigation li{max-height: 4rem; 	opacity:1;}
	nav .navigation li a{ 		font-size: 0;		transition: all .3s ease-in-out;}
	nav.open .navigation li a{	font-size: 1rem;}
	
	.main{width: 90%; padding:1rem;}
	.imgwrap{max-width: 45%; margin:1%; }
	.imgwrap.video{max-width:95%;}
}
@media(max-height:300px) {
	nav li{min-width: 25%;}
}
</style>
</head><body id="body">

<?php // Header ?>
<?php $album = $_GET['a']; ?>
<nav id="navigation">
	<div class="title">
		<a href="/?a=<?php echo $album; ?>" id="back">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><path fill="#fff" d="M990 500c0-270.6-219.4-490-490-490S10 229.4 10 500s219.4 490 490 490 490-219.4 490-490zM536.7 267l63.3 63.3-173.3 173.3 188.7 188.7-63 63-252-252L536.7 267z"/></svg>
			Galerie<span id="albumname"> <?php echo $album; ?></span>
		</a>
	</div>
	<div id="navtoggle" class="navtoggle"><a href="javascript:document.getElementById('navigation').classList.toggle('open');">&#9776;</a></div>
	<div id="sitenavigation" class="navigation">
		<ul>
			<li><a href="download.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"/><path d="M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z"/></g></svg>
				Download</a></li>
			<li><a target="_blank" href="https://hackedit.de/contact">
				<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 1792 1792"><path d="M1664 1504V736q-32 36-69 66-268 206-426 338-51 43-83 67t-86.5 48.5T897 1280h-2q-48 0-102.5-24.5T706 1207t-83-67q-158-132-426-338-37-30-69-66v768q0 13 9.5 22.5t22.5 9.5h1472q13 0 22.5-9.5t9.5-22.5zm0-1051v-24.5l-.5-13-3-12.5-5.5-9-9-7.5-14-2.5H160q-13 0-22.5 9.5T128 416q0 168 147 284 193 152 401 317 6 5 35 29.5t46 37.5 44.5 31.5T852 1143t43 9h2q20 0 43-9t50.5-27.5 44.5-31.5 46-37.5 35-29.5q208-165 401-317 54-43 100.5-115.5T1664 453zm128-37v1088q0 66-47 113t-113 47H160q-66 0-113-47T0 1504V416q0-66 47-113t113-47h1472q66 0 113 47t47 113z"/></svg>
				Feedback</a></li>
			<li><a href="upload-old.php?a=<?php echo $album; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff" viewBox="0 0 24 24"><g><path d="M16.5 16c1.378 0 2.5-1.122 2.5-2.5 0-1.379-1.122-2.5-2.5-2.5s-2.5 1.121-2.5 2.5c0 1.378 1.122 2.5 2.5 2.5zM7.5 11c-1.378 0-2.5 1.121-2.5 2.5 0 1.378 1.122 2.5 2.5 2.5s2.5-1.122 2.5-2.5c0-1.379-1.122-2.5-2.5-2.5zM20.992 10c-1.954 0-3.933-1.393-3.933-4.5 0-.277.224-.5.5-.5s.5.223.5.5c0 2.58 1.519 3.5 2.941 3.5l.8.012c-.924-4.565-4.967-8.012-9.8-8.012-4.829 0-8.869 3.441-9.798 8h.798c1.422 0 2.941-.92 2.941-3.5 0-.277.224-.5.5-.5s.5.223.5.5c0 3.107-1.98 4.5-3.941 4.5h-.949c-.033.329-.051.662-.051 1v2.5c0 2.865 2.201 5.223 5 5.478v5.022h3v-5.5c0-.277.224-.5.5-.5s.5.223.5.5v5.5h2v-5.5c0-.277.224-.5.5-.5s.5.223.5.5v5.5h3v-5.022c2.799-.254 5-2.613 5-5.478v-2.5c0-.333-.018-.662-.05-.985l-.958-.015zm-13.492 7c-1.93 0-3.5-1.57-3.5-3.5 0-1.931 1.57-3.5 3.5-3.5s3.5 1.569 3.5 3.5c0 1.93-1.57 3.5-3.5 3.5zm5.01 0h-1.01c-.372 0-.613-.393-.447-.724l.5-1c.169-.34.725-.34.895 0l.46.919c.251.335.012.805-.398.805zm.49-3.5c0-1.931 1.57-3.5 3.5-3.5s3.5 1.569 3.5 3.5c0 1.93-1.57 3.5-3.5 3.5s-3.5-1.57-3.5-3.5z"/></g></svg>
				alter Uploader</a></li>
		</ul>
	</div>
</nav>
<?php // End-Header ?>
<?php // Upload ?>

<div class="main">
	<div style="text-align: left;">
		<?php // <h2>Der Upload von Dateien >1MB funktioniert derzeit nicht. </br>Es wird an einer Lösung gearbeitet...</h2></br> ?>
		<b>Hinweise:</b>
		<ul style="margin-left: 2rem;">
			<li>Jede Datei darf maximal <b>90MB</b> groß sein.</li>
			<noscript><li>Es können maximal <b>16 Dateien</b> auf einmal hochgeladen werden.</li></noscript>
			<li>Nur die Formate ".jp(e)g", ".png", ".gif", ".mp4", ".ogg", ".webm" sind erlaubt.</li>
		</ul>
	</div>
	
	
	<script src="dropzone.min.js"></script>
	<form action="dropzoneupload.php?a=<?php echo $album; ?>" class="dropzone hidden" id="dropzone">
		<div class="dz-message">
			Drop files here<br>or click to upload.<br>
			<span>Be carefull, the selected files are automatically uploaded.</span>
		</div>
	</form>
	<script>
	document.getElementById("dropzone").classList.toggle('hidden');
	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone(
		"#dropzone", 
		{ 
			url: "dropzoneupload.php?a=<?php echo $album; ?>",
			parallelUploads: 10,
			maxFilesize: 90,
			addRemoveLinks:false,
			uploadMultiple:false,
			acceptedFiles: ".jpg,.jpeg,.png,.gif,.mp4,.ogg,.webm",
			autoProcessQueue:true
		}
	);
	</script>	

	<noscript>	
		<form method="post" action="fileupload.php?a=<?php echo $album; ?>" class="noscriptform" enctype="multipart/form-data">
			<input type="file" name="files[]" multiple="multiple" accept=".jpg,.jpeg,.png,.gif,.mp4,.ogg,.webm"/></br>
			<input type="submit" id="submitimg" value="Upload!" />
			<label id="Lsubmitimg" for="submitimg">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"></path><path d="M235.47 8.65C241.01 3.11 248.51 0 256.33 0s15.3 3.1 20.84 8.64l118.9 118.9c11.52 11.5 11.52 30.1 0 41.6-11.5 11.52-30.18 11.52-41.7 0l-68.57-68.5v253.13c0 16.28-13.2 29.48-29.45 29.48-16.3 0-29.5-13.2-29.5-29.5V100.67l-68.54 68.56c-11.5 11.52-30.2 11.5-41.7 0-11.5-11.5-11.5-30.18 0-41.7l118.9-118.9z"></path></g></svg>
				2. Upload
			</label>
		</form> 
	</noscript>
</div>
<?php // End-Upload ?>
<p style="text-align:center;color:#555;padding:5px;font-size:.6rem;">&copy; Copyright <a href="https://adrianjost.hackedit.de" rel="nofollow" style="color:#000";>Adrian Jost</a></p>
</body></html>