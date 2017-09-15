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
<meta name="theme-color" content="<?php echo $color[1]; ?>">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<link rel="icon" type="image/vnd.microsoft.icon" href="inc/favicon.ico">
<link rel="icon" type="image/png" href="inc/favicon.png">
<link href="inc/dropzone.min.css" type="text/css" rel="stylesheet" />
<link href="inc/style.css?v=24" type="text/css" rel="stylesheet">
<link href="inc/dropzone.min.css" type="text/css" rel="stylesheet" />
<style>
body:before,
.main #Lsubmitimg{background: <?php echo $color[0]; ?>;}
a,
.dropzone .dz-message{color:<?php echo $color[0]; ?>;}
a:hover{color:<?php echo $color[1]; ?>;}
.dropzone {border: 2px dashed <?php echo $color[0]; ?>;}
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
			<li><a href="index.php?a=<?php echo $album; ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="453.33" height="379" viewBox="0 0 453.333 379"><g fill="#fff"><path d="M226.35 78.95L70.6 214.28c0 .2-.04.48-.13.86-.1.38-.13.65-.13.85v137c0 4.94 1.7 9.23 5.14 12.84 3.43 3.6 7.5 5.43 12.2 5.43h104v-109.6h69.34v109.65h104c4.7 0 8.77-1.82 12.2-5.44 3.43-3.6 5.15-7.9 5.15-12.87V216c0-.77-.1-1.34-.27-1.72L226.35 78.95z"></path><path d="M441.68 183.45l-59.32-51.96V15c0-2.66-.8-4.85-2.44-6.57-1.6-1.7-3.7-2.56-6.22-2.56h-52c-2.54 0-4.6.85-6.24 2.56-1.62 1.72-2.44 3.9-2.44 6.57v55.67l-66.08-58.24C241.16 7.48 234.3 5 226.36 5c-7.95 0-14.8 2.48-20.6 7.43L11.03 183.45c-1.8 1.52-2.8 3.56-2.98 6.14-.2 2.52.44 4.8 1.9 6.7l16.78 21.1c1.45 1.7 3.34 2.76 5.7 3.14 2.16.2 4.33-.48 6.5-2l187.42-164.7L413.8 218.56c1.43 1.33 3.33 2 5.67 2h.82c2.3-.4 4.2-1.44 5.65-3.15l16.8-21.12c1.43-1.9 2.07-4.15 1.88-6.72-.2-2.56-1.18-4.6-2.98-6.13z"></path></g></svg>
				Home</a></li>
			<li><a href="download.php?a=<?php echo $album; ?>">
				<svg viewBox="0.328 0 512 526.05"><g fill="#fff"><path d="M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z"/><path d="M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z"/></g></svg>
				Download</a></li>
		</ul>
	</div>
</nav>
<?php // End-Header ?>
<?php // Upload ?>

<div class="main box">
	<div style="text-align: left;">
		<?php // <h2>Der Upload von Dateien >1MB funktioniert derzeit nicht. </br>Es wird an einer Lösung gearbeitet...</h2></br> ?>
		<b>Hinweise:</b>
		<ul style="margin-left: 2rem;width:100%;">
			<li>Jede Datei darf maximal <b>90MB</b> groß sein.</li>
			<noscript><li>Es können maximal <b>16 Dateien</b> auf einmal hochgeladen werden.</li></noscript>
			<li>Nur die Formate ".jp(e)g", ".png", ".gif", ".mp4", ".ogg", ".webm" sind erlaubt.</li>
		</ul>
	</div>
	
	
	<script src="inc/dropzone.min.js"></script>
	<form action="inc/dropzoneupload.php?a=<?php echo $album; ?>" class="dropzone hidden" id="dropzone">
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
			url: "inc/dropzoneupload.php?a=<?php echo $album; ?>",
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