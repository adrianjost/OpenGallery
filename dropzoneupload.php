<?php
$ds          = DIRECTORY_SEPARATOR;
$storeFolder = $_GET['a'];
$valid_formats = array("jpg", "jpeg", "png", "gif", "mp4", "webm", "ogg");
$max_file_size = 1024*1024*100; //100 mb

if (!empty($_FILES)) {
	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	if ($_FILES['file']['size'] > $max_file_size){header("HTTP/1.1 413 Request Entity Too Large");}
	elseif(!in_array(strtolower($ext), $valid_formats) ){header("HTTP/1.1 415 Unsupported Media Type");}
	else{
		$tempFile = $_FILES['file']['tmp_name'];         
		$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
		$filename = time()."-".$_FILES['file']['name'];
		$targetFile =  $targetPath . str_replace(".".$ext, ".".strtolower($ext), $filename);
		move_uploaded_file($tempFile,$targetFile);
		
		image_fix_orientation($targetFile);
		
		$fp = fopen($_GET['a']."/lastup.txt", 'w');
		fwrite($fp, time());
		fclose($fp);
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
?>    