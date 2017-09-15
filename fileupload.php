<?php 
if(!isset($_GET['a'])){header("HTTP/1.1 403 Forbidden"); header("Location: upload.php"); exit();}

ini_set('max_execution_time', 6000);
ini_set('memory_limit','2048M');
ignore_user_abort(true);

$valid_formats = array("jpg", "jpeg", "png", "gif", "mp4", "webm", "ogg");
$max_file_size = 1024*1024*200; //200 mb
$path = __DIR__."/".$_GET['a']."/"; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) { continue; } // Skip file if any error found
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size){$message[] = "$name is too large!."; continue;} // Skip large files  
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){$message[] = "$name is not a valid format";continue; }// Skip invalid file formats
	        else{ // No error found! Move uploaded files 
				$ext = ".".pathinfo($name, PATHINFO_EXTENSION);
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.time()."-".$name)){ $count++; }
	        }
	    }
	}
}

$fp = fopen($_GET['a']."/lastup.txt", 'w');
fwrite($fp, time());
fclose($fp);

header("Location: index.php?a=".$_GET['a']);
exit();
?>