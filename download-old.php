<?php
/*
 * PHP: Recursively Backup Files & Folders to ZIP-File
 * (c) 2012-2014: Marvin Menzerath - http://menzerath.eu
 * scr: https://gist.github.com/MarvinMenzerath/4185113
 * edited by Adrian Jost (2016) - https://hackedit.de
*/
// Make sure the script can handle large folders/files
//ini_set('max_execution_time', 300);
//ini_set('memory_limit','1536M');
//ignore_user_abort(true);

$source = __DIR__."/".$_GET['a'];
$destination = $_GET['a']."/".$_GET['a']."-files";


if(	(	!file_exists($destination."-1.zip") 
	|| 	(file_exists($_GET['a']."/lastup.txt") && (filemtime($_GET['a']."/lastup.txt") > filemtime($destination."-1.zip")))
	|| 	isset($_GET['i'])
	|| 	isset($_GET['n']))
	&& !isset($_GET['list'])
	){
	zipData($source, $destination);
}
else{
	downloadpage();
	exit();
}

// Here the magic happens :)
function zipData($source, $destination) {
	$sumsize = 0;
	$itemnr = 0;
	
	if (isset($_GET['i'])){$index = $_GET['i'];} 
	else {
		//start new zip process --> delete all old files
		$index = 1;
		$files = glob($_GET['a']."/*.{zip}", GLOB_BRACE);
		foreach ($files as $file) {unlink($file);}
	}
	
	$zip = new ZipArchive;
	if ($zip->open($destination."-".$index.".zip", ZIPARCHIVE::CREATE) === TRUE) {
		$files = glob($_GET['a']."/*.{jpg,jpeg,png,gif,mp4,ogg,webm}", GLOB_BRACE);
		rsort($files);
		foreach ($files as $file) {
			if (isset($_GET['n']) && $itemnr < $_GET['n']){$itemnr = $itemnr +1;}
			else{
				if (($sumsize + filesize($file)) > 12e7){
					$zip->close();
					header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
					echo "Generating zip file ".($index+1)."... Generating all zip files can take very long time... Please do nothing, we will redirect you if finished.
					<noscript><a href='".$_GET['a']."&i=".($index + 1)."&n=".$itemnr."'>You habe to click this link to continue, because you disabled Javascript in your browser</a></noscript>
					<script type='text/javascript'>window.location = 'download.php?a=".$_GET['a']."&i=".($index + 1)."&n=".$itemnr."'</script>
					";
					//header("Location: download.php?a=".$_GET['a']."&i=".($index + 1)."&n=".$itemnr);
					exit();
				}
				$zip->addFile($file, basename($file));
				$itemnr = $itemnr + 1;
				$sumsize = $sumsize + filesize($file);
			}
		}
		$zip->close();
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		echo "All zip files are generated! redirecting to download list...
		<noscript><a href='".$_GET['a']."&list'>You habe to click this link to continue, because you disabled Javascript in your browser</a></noscript>
		<script type='text/javascript'>window.location = 'download.php?a=".$_GET['a']."&list'</script>
		";
		exit();
	} else { //echo 'failed'; 
	}
}

function downloadpage(){
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	echo "<style>
	a{
		font: 400 16px/20px 'Segoe UI', sans-serif;
		-webkit-font-smoothing: antialiased;
		padding: 5px;
		display:block;
		color: #2196F3;
	}
	</style>";
	echo "<a href='index.php?a=".$_GET['a']."' style='font-weight: 700;'>< Zurück zum Album</a></br>";
	
	$files = glob($_GET['a']."/*.{zip}", GLOB_BRACE); // all zip files
	
	// Download all - 1 Click
	echo "Click the following link to download all files at once.<br>(maybe your browser is going to block the pop-ups and only one file is downloaded. Then you have to use the lower links.)";
	echo "<a href='javascript:download()'>click to download all</a><script>function download() {";
	foreach ($files as $file) {
		echo "window.open('http://".$_SERVER['HTTP_HOST']."/".$file."', '".basename($file)."');";
	}
	echo "}</script></br></br>";
	
	echo "Click on one of the following links to download the appropriate file:";
	// Download just a part
	foreach ($files as $file) {
		echo "<a target='_blank' href='".$file."'>download ".basename($file)." (".formatsize(filesize($file)).")</a>";
	}
}

// filesizeformat
function formatsize($bytes){
	if 	($bytes >= 1048576)		{$bytes = number_format($bytes / 1048576, 2) . ' MB';}
	elseif 	($bytes >= 1024)		{$bytes = number_format($bytes / 1024, 2) . ' KB';}
	elseif 	($bytes > 1)			{$bytes = $bytes . ' bytes';}
	elseif 	($bytes == 1)			{$bytes = $bytes . ' byte';}
	else							{$bytes = '0 bytes';}
	return $bytes;
}
?>