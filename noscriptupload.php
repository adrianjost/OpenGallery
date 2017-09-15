<?php 
require("inc/functions.php");
require("inc/sqlite.php");

//ini_set('max_execution_time', 6000);
//ini_set('post_max_size', '100M');
//ignore_user_abort(true);

$valid_formats = array("jpg", "jpeg", "png", "gif", "mp4", "webm", "ogg");
$max_file_size = 1024*1024*100; //100 mb
$path = __DIR__."/".$album."/"; // Upload directory

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) { continue; } // Skip file if any error found
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size){$message[] = "$name is too large!."; continue;} // Skip large files  
			elseif( ! in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), $valid_formats) ){$message[] = "$name is not a valid format";continue; }// Skip invalid file formats
	        else{ // No error found! Move uploaded files 
				$ext = ".".pathinfo($name, PATHINFO_EXTENSION);
				$name = str_replace($ext, strtolower($ext), $name);
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.time()."-".$name)){ 
					image_fix_orientation($path.time()."-".$name);
					plus_item();	// Update Database
					plus_foldersize(filesize($path.time()."-".$name));
				}
	        }
	    }
	}
}

function image_fix_orientation($filename) {
	$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	if(!($ext=="jpg"||$ext=="jpeg")){return;}
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
        imagejpeg($image, $filename, 90);
    }
}

/*
$fp = fopen($path."/lastup.txt", 'w');
fwrite($fp, time());
fclose($fp);
*/

header("Location: index.php");
exit();
?>