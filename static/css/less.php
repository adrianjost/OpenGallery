<?php
    require 'lessc.inc.php';
    
    header("HTTP/1.1 200 OK", true);
	header("Content-Type: text/css");
	header('X-Powered-By:PHP/'.phpversion()); 
    
    $prefix = "/gallery";
    $path = __DIR__ . str_replace($prefix."/static/css","",$_SERVER[REQUEST_URI]);
    
    $less = new lessc('test.less');
    echo $less->compileFile(str_replace(".css",".less",$path)); 
?>