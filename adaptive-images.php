<?php
/* PROJECT INFO --------------------------------------------------------------------------------------------------------
   Version:   1.5.2
   Changelog: http://adaptive-images.com/changelog.txt

   Homepage:  http://adaptive-images.com
   GitHub:    https://github.com/MattWilcox/Adaptive-Images
   Twitter:   @responsiveimg

   LEGAL:
   Adaptive Images by Matt Wilcox is licensed under a Creative Commons Attribution 3.0 Unported License.

/* CONFIG ----------------------------------------------------------------------------------------------------------- */
//ini_set('max_execution_time', 6000);
//ini_set('memory_limit','1024M');
ignore_user_abort(true);

$resolutions   = array(300, 150); // the resolution break-points to use (screen widths, in pixels)
$cache_path    = "gallery/thumbs"; // where to store the generated re-sized images. Specify from your document root!
$jpg_quality   = 75; // the quality of any generated JPGs on a scale of 0 to 100
$sharpen       = TRUE; // Shrinking images can blur details, perform a sharpen on re-scaled images?
$watch_cache   = TRUE; // check that the adapted image isn't stale (ensures updated source images are re-cached)
$browser_cache = 60*60*24*7; // How long the BROWSER cache should last (seconds, minutes, hours, days. 7days by default)

/* END CONFIG ----------------------------------------------------------------------------------------------------------
------------------------ Don't edit anything after this line unless you know what you're doing -------------------------
--------------------------------------------------------------------------------------------------------------------- */
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
}
set_error_handler("exception_error_handler");
/* get all of the required data from the HTTP request */
$document_root  = $_SERVER['DOCUMENT_ROOT'];
//$requested_uri  = "/gallery".parse_url(urldecode(strtok($_SERVER["REQUEST_URI"],'?')), PHP_URL_PATH);
$requested_uri  = "/gallery".parse_url(urldecode($_SERVER["REQUEST_URI"]), PHP_URL_PATH);
$requested_file = basename($requested_uri);
$source_file    = $document_root.$requested_uri;
$resolution     = FALSE;

// does the $cache_path directory exist already?
if (!is_dir("$document_root/$cache_path")) { // no
	if (!mkdir("$document_root/$cache_path", 0755, true)) { // so make it
		if (!is_dir("$document_root/$cache_path")) { // check again to protect against race conditions
			sendErrorImage("Failed to create cache directory at: $document_root/$cache_path"); // uh-oh, failed to make that directory
}}}

/* helper function: Send headers and returns an image. */
function sendImage($filename, $browser_cache) {
	global $source_file;
	if (filesize($filename) <= 2000){
		unlink($filename);
		//$filename = $source_file;
		//$filename = "sorry.jpg";
		header('Location: https://gallery.hackedit.de/sorry.jpg');
		exit();
	}
	$extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	if (in_array($extension, array('png', 'gif', 'jpeg'))) {
	header("Content-Type: image/".$extension);
	} else {
	header("Content-Type: image/jpeg");
	}
	header("Cache-Control: private, max-age=".$browser_cache);
	header('Last-Modified: '.gmdate('D, d M Y H:i:s', time()+0).' GMT');
	header('Date: '.gmdate('D, d M Y H:i:s', time()+0).' GMT');
	header('Expires: '.gmdate('D, d M Y H:i:s', time()+$browser_cache).' GMT');
	header('Content-Length: '.filesize($filename));
	readfile($filename);
	exit();
}

/* helper function: Create and send an image with an error message. */
function sendErrorImage($message) {
  /* get all of the required data from the HTTP request */
  $document_root  = $_SERVER['DOCUMENT_ROOT'];
  $requested_uri  = parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH);
  $requested_file = basename($requested_uri);
  $source_file    = $document_root.$requested_uri;

  $im            = ImageCreateTrueColor(800, 300);
  $text_color    = ImageColorAllocate($im, 233, 14, 91);
  $message_color = ImageColorAllocate($im, 91, 112, 233);

  ImageString($im, 5, 5, 5, "Adaptive Images encountered a problem:", $text_color);
  ImageString($im, 3, 5, 25, $message, $message_color);

  ImageString($im, 5, 5, 85, "Potentially useful information:", $text_color);
  ImageString($im, 3, 5, 105, "DOCUMENT ROOT IS: $document_root", $text_color);
  ImageString($im, 3, 5, 125, "REQUESTED URI WAS: $requested_uri", $text_color);
  ImageString($im, 3, 5, 145, "REQUESTED FILE WAS: $requested_file", $text_color);
  ImageString($im, 3, 5, 165, "SOURCE FILE IS: $source_file", $text_color);

  header("Cache-Control: no-store");
  header('Expires: '.gmdate('D, d M Y H:i:s', time()-1000).' GMT');
  header('Content-Type: image/jpeg');
  ImageJpeg($im);
  ImageDestroy($im);
  exit();
}

/* sharpen images function */
function findSharp($intOrig, $intFinal) {
  $intFinal = $intFinal * (750.0 / $intOrig);
  $intA     = 52;
  $intB     = -0.27810650887573124;
  $intC     = .00047337278106508946;
  $intRes   = $intA + $intB * $intFinal + $intC * $intFinal * $intFinal;
  return max(round($intRes), 0);
}

/* refreshes the cached image if it's outdated */
function refreshCache($source_file, $cache_file, $resolution) {
  if (file_exists($cache_file)) {
    // not modified
    if (filemtime($cache_file) >= filemtime($source_file)) {
      return $cache_file;
    }

    // modified, clear it
    unlink($cache_file);
  }
  return generateImage($source_file, $cache_file, $resolution);
}

/* generates the given cache file for the given source file with the given resolution */
function generateImage($source_file, $cache_file, $resolution) {
  global $sharpen, $jpg_quality, $browser_cache;

  $extension = strtolower(pathinfo($source_file, PATHINFO_EXTENSION));

  // Check the image dimensions
  $dimensions   = GetImageSize($source_file);
  $width        = $dimensions[0];
  $height       = $dimensions[1];

  // Do we need to downscale the image?
  if ($width <= $resolution) { // no, because the width of the source image is already less than the client width
    return $source_file;
  }

  // We need to resize the source image to the width of the resolution breakpoint we're working with
  $ratio      = $height/$width;
  $new_width  = $resolution;
  $new_height = ceil($new_width * $ratio);
  $dst        = ImageCreateTrueColor($new_width, $new_height); // re-sized image

  switch ($extension) {
    case 'png':
      $src = @ImageCreateFromPng($source_file); // original image
    break;
    case 'gif':
      $src = @ImageCreateFromGif($source_file); // original image
    break;
    default:
      $src = @ImageCreateFromJpeg($source_file); // original image
      ImageInterlace($dst, true); // Enable interlancing (progressive JPG, smaller size file)
    break;
  }

  if($extension=='png'){
    imagealphablending($dst, false);
    imagesavealpha($dst,true);
    $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
    imagefilledrectangle($dst, 0, 0, $new_width, $new_height, $transparent);
  }
  try{
	ImageCopyResampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height); // do the resize in memory
	ImageDestroy($src);
  } catch(Exception $e){
	  sendImage($source_file, $browser_cache);
	  exit();
  }

  // sharpen the image?
  // NOTE: requires PHP compiled with the bundled version of GD (see http://php.net/manual/en/function.imageconvolution.php)
  if($sharpen == TRUE && function_exists('imageconvolution')) {
    $intSharpness = findSharp($width, $new_width);
    $arrMatrix = array(
      array(-1, -2, -1),
      array(-2, $intSharpness + 12, -2),
      array(-1, -2, -1)
    );
    imageconvolution($dst, $arrMatrix, $intSharpness, 0);
  }

  $cache_dir = dirname($cache_file);

  // does the directory exist already?
  if (!is_dir($cache_dir)) { 
    if (!mkdir($cache_dir, 0755, true)) {
      // check again if it really doesn't exist to protect against race conditions
      if (!is_dir($cache_dir)) {
        // uh-oh, failed to make that directory
        ImageDestroy($dst);
        sendErrorImage("Failed to create cache directory: $cache_dir");
      }
    }
  }

  if (!is_writable($cache_dir)) {
    sendErrorImage("The cache directory is not writable: $cache_dir");
  }

  // save the new file in the appropriate path, and send a version to the browser
  switch ($extension) {
    case 'png':
      $gotSaved = ImagePng($dst, $cache_file);
    break;
    case 'gif':
      $gotSaved = ImageGif($dst, $cache_file);
    break;
    default:
      $gotSaved = ImageJpeg($dst, $cache_file, $jpg_quality);
    break;
  }
  ImageDestroy($dst);

  if (!$gotSaved && !file_exists($cache_file)) {
    sendErrorImage("Failed to create image: $cache_file");
  }

  return $cache_file;
}

// check if the file exists at all
if (!file_exists($source_file)) {
  header("Status: 404 Not Found");
  exit();
}

/* check that PHP has the GD library available to use for image re-sizing */
if (!extension_loaded('gd')) { // it's not loaded
  if (!function_exists('dl') || !dl('gd.so')) { // and we can't load it either
    // no GD available, so deliver the image straight up
    trigger_error('You must enable the GD extension to make use of Adaptive Images', E_USER_WARNING);
    sendImage($source_file, $browser_cache);
  }
}


if(isset($_GET["r"])){
	$rresolution = $_GET["r"];
	if (in_array($rresolution, $resolutions)){$resolution = $rresolution;}
	else{sendImage($source_file, $browser_cache);exit();
}}


/* if the requested URL starts with a slash, remove the slash */
if(substr($requested_uri, 0,1) == "/") {
  $requested_uri = substr($requested_uri, 1);
}

/* whew might the cache file be? */
$newfile = $requested_file.".".$resolution."px";
$fileurl = str_replace($requested_file,"", $requested_uri);
$cache_file = $document_root."/$cache_path/$fileurl/".$newfile;

/* Use the resolution value as a path variable and check to see if an image of the same name exists at that path */
if (file_exists($cache_file)) { // it exists cached at that size
  if ($watch_cache) { // if cache watching is enabled, compare cache and source modified dates to ensure the cache isn't stale
    $cache_file = refreshCache($source_file, $cache_file, $resolution);
  }

  sendImage($cache_file, $browser_cache);
}

/* It exists as a source file, and it doesn't exist cached - lets make one: */
$file = generateImage($source_file, $cache_file, $resolution);
sendImage($file, $browser_cache);