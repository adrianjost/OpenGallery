<?php
	ignore_user_abort(true);
	ob_start();
?>
<html>
<head><script>close();</script></head>
<body></body>
</html>
<?php
	@ob_end_flush();
	unlink($_GET['file']);
	//sleep(.2);
	//header("Location: index.php?a=".$_GET['a']."&admin");
	exit();
?>