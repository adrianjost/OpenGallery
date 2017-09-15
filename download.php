<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

require("inc/functions.php");


$source = __DIR__."/".$album;
$destination = $album."/".$album."-files";

include("inc/html/head.php");
?>
<style>
body:before,
.main .bt{background-color: <?php echo $color[0]; ?>;}
.main{ margin: 7.5rem auto 1rem;}
a{color:<?php echo $color[0]; ?>;}
a:hover{color:<?php echo $color[1]; ?>;}
.main .bt:hover{ background-color: <?php echo $color[1]; ?>;}
</style>
</head><body id="body">

<?php // Header ?>
<?php include("inc/html/nav.php"); ?>
<?php // End-Header ?>
<?php // Download ?>

<div class="main box">
	<div class='text'>
	<?php 
	$itemnr	= 0;
	if((	!file_exists($album."/lastzip.txt")
			|| (file_exists($album."/lastup.txt") 
				&& file_exists($album."/lastzip.txt")
				&& ( 
					filemtime($album."/lastup.txt") > filemtime($album."/lastzip.txt") )
				)
		)
		&& !isset($_GET['i'])
		&& !isset($_GET['n'])
		&& !isset($_GET['list'])
	){
			
		$files = glob($album."/*.{zip}", GLOB_BRACE);
		foreach ($files as $file) {unlink($file);}
		$index	= 0;
		nextpage();
	}
	elseif(	isset($_GET['i'])
		&& 	isset($_GET['n'])
		&& !isset($_GET['list'])
		){
		$index = $_GET['i'];
		$maxn  = $_GET['n'];
		//nextpage();
		zipData($source, $destination);
	}
	else{
		downloadpage();
	}
	function nextpage(){
		global $album, $index, $itemnr;
		echo "
			<b>Generating zip file ".($index+1)."...</b></br>
			<div class='loading'></div>
			<span class='info' id='info' style='display:none'>Generating all zip files can take very long time... Please do nothing, we will redirect you if finished.</span></br>
			<script type='text/javascript'>
			document.getElementById('info').removeAttribute('style');
			window.location = 'download.php?i=".($index + 1)."&n=".$itemnr."'</script>

			
			<noscript>
			<b class='info' style='font-size:1rem;'>You have to click this link to continue, because you disabled Javascript in your browser</b>
			<a href='download.php?i=".($index + 1)."&n=".$itemnr."' class='bt'>CONTINUE
			<svg style='height:.8rem;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 18 46'><path d='M1.76 1.3L15.74 23 1.76 44.7' fill='none' stroke='#fff' stroke-width='15'></path></svg>
			</a></noscript>
					";
	}
	function downloadpage(){
		global $album;
		$files = glob($album."/*.{zip}", GLOB_BRACE); // all zip files
		// Download all - 1 Click
		echo "<b>Download all files at once</b><br><span class='info'>maybe your browser is going to block the pop-ups and only one file is downloaded. Then you have to use the lower links.</span>";
		echo "<a href='javascript:download()' class='bt'>
			<svg viewBox='0.328 0 512 526.05'><g fill='#fff'><path d='M482.84 308.1c-16.28 0-29.48 13.2-29.48 29.5v129.48H59.3v-129.5c0-16.28-13.2-29.48-29.48-29.48-16.3 0-29.5 13.2-29.5 29.5v158.96c0 16.3 13.2 29.5 29.5 29.5h453.02c16.3 0 29.5-13.2 29.5-29.5V337.6c0-16.3-13.2-29.5-29.5-29.5z'/><path d='M235.47 374.6c5.54 5.54 13.04 8.65 20.86 8.65s15.3-3.1 20.84-8.64l118.9-118.9c11.52-11.5 11.52-30.1 0-41.6-11.5-11.52-30.18-11.52-41.7 0l-68.57 68.5V29.48C285.8 13.2 272.6 0 256.35 0c-16.3 0-29.5 13.2-29.5 29.5v253.08l-68.54-68.56c-11.5-11.52-30.2-11.5-41.7 0-11.5 11.5-11.5 30.18 0 41.7l118.9 118.9z'/></g></svg>
			DOWNLOAD ALL</a><script>function download(){";
		foreach ($files as $file){echo "window.open('http://".$_SERVER['HTTP_HOST']."/".$file."', '".basename($file)."');";}
		echo "}</script>";
		// Download just a part
		echo "<b>Single-File Download</b><ul>";
		foreach ($files as $file) {
			echo "<li><a target='_blank' href='".$file."'>".basename($file)."<span class='info'>(".formatsize(filesize($file)).")</span></a></li>";
		}
		echo "</ul>";
	}
	?>
	</div>
</div>
<?php // End-Download 
include("inc/html/footer.php"); ?>

<?php // filesizeformat

// Here the magic happens :)
function zipData($source, $destination) {
	global $album, $index, $itemnr, $maxn;
	$sumsize = 0;
	$zip = new ZipArchive;
	if ($zip->open($destination."-".$index.".zip", ZIPARCHIVE::CREATE) === TRUE) {
		$files = glob($album."/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE);
		sort($files);
		foreach ($files as $file) {
			if ($itemnr < $maxn){$itemnr = $itemnr +1;}
			else{
				if (($sumsize + filesize($file)) >= 115e6){
					$zip->close();
					nextpage();
					return;
				}
				$zip->addFile($file, basename($file));
				$itemnr = $itemnr + 1;
				$sumsize = $sumsize + filesize($file);
			}
		}
		$zip->close();
		
		$fp = fopen($album."/lastzip.txt", 'w');
		fwrite($fp, time());
		fclose($fp);
		
		echo "<b>All ".($index)." files generated</b></br>
			<span class='info' id='info'>Click continue to get them.</br>
			
			<a href='download.php' class='bt'>CONTINUE
			<svg style='height:.8rem;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 18 46'><path d='M1.76 1.3L15.74 23 1.76 44.7' fill='none' stroke='#fff' stroke-width='15'></path></svg>
			</a>
			<script type='text/javascript'>window.location = 'download.php'</script>";
		
		
	} else { //echo 'failed'; 
		return;
	}
}
?>