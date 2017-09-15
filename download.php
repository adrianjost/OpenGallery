<?php
/*
 * PHP: Recursively Backup Files & Folders to ZIP-File
 * (c) 2012-2014: Marvin Menzerath - http://menzerath.eu
 * scr: https://gist.github.com/MarvinMenzerath/4185113
 * edited by Adrian Jost (2016) - https://hackedit.de
*/
// Make sure the script can handle large folders/files
ini_set('max_execution_time', 6000);
ini_set('memory_limit','2048M');
ignore_user_abort(true);


$source = __DIR__."/".$_GET['a'];
$destination = $_GET['a']."/".$_GET['a']."-files.zip";

if(filemtime($_GET['a']."/lastup.txt") > filemtime($destination)){
	//echo "regenerate...";
	// delete old zip
	if (is_file($destination)){unlink($destination);}
	// Start the zipping!
	zipData($source, $destination);
}
//updatelist($destination);

$file_name = $_GET['a']."/".$_GET['a']."-files.zip";
header('Pragma: public'); 	// required
header('Expires: 0');		// no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
header('Cache-Control: private',false);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($file_name));	// provide file size
header('Connection: close');
readfile($file_name);		// push it out
exit();

//header("Location: ".$_GET['a']."/".$_GET['a']."-files.zip");
//echo 'Finished. <script>window.close()</script>';

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

// Here the magic happens :)
function zipData($source, $destination) {
	if (extension_loaded('zip')) {
		if (file_exists($source)) {
			if(!file_exists(dirname($destination))){mkdir(dirname($destination), 0777, true);}	
			$zip = new ZipArchive();
			if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
				$source = realpath($source);
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
						} else if (is_file($file) && (!strpos($file, ".zip") !== false)) {	// exclude zip files
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
						}
					}
				} 
				else if (is_file($source) && (!strpos($file, ".zip") !== false)) { 			// exclude zip files
					$zip->addFromString(basename($source), file_get_contents($source));
				}
			}
			else{ echo "ERROR - can't open zip</br>"; }
			return $zip->close();
		}
		else{ echo "ERROR - source does not exist</br>"; }
	}
	else{ echo "ERROR - no zip extension found</br>"; }
	return false;
}
?>