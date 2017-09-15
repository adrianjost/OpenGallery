<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); ?>
<?php // https://gallery.hackedit.de/updateDB.php?a=...&title=...
require("inc/functions.php");
require("inc/sqlite.php");

updatefolder();
if(isset($_GET["title"])){
	set_FolderName($_GET["title"]);
}
?>
<p>updated</p>