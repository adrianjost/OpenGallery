<?php
	ignore_user_abort(true);
	unlink($_GET['file']);
	sleep(.2);
	header("Location: index.php?a=".$_GET['a']."&admin");
	exit();
?>