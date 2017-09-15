<?php 
require("inc/functions.php");
include("inc/html/head.php");
?>

<link href="inc/css/dropzone.min.css" type="text/css" rel="stylesheet" />
<style>
body:before,
.main #Lsubmitimg{background: <?php echo $color[0]; ?>;}
a,
.dropzone .dz-message{color:<?php echo $color[0]; ?>;}
a:hover{color:<?php echo $color[1]; ?>;}
.dropzone {border: 2px dashed <?php echo $color[0]; ?>;}
</style>
</head><body id="body">

<?php include("inc/html/nav.php"); ?>

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
	
	
	<script src="inc/js/dropzone.min.js"></script>
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
			parallelUploads: 5,
			maxFilesize: 90,
			addRemoveLinks:false,
			uploadMultiple:false,
			acceptedFiles: ".jpg,.jpeg,.png,.gif,.mp4,.ogg,.webm",
			autoProcessQueue:true
		}
	);
	</script>	

	<noscript>	
		<form method="post" action="noscriptupload.php?a=<?php echo $album; ?>" class="noscriptform" enctype="multipart/form-data">
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
<?php include("inc/html/footer.php"); ?>