<?php
	ignore_user_abort(true);
	unlink($_GET['file']);
	sleep(1);
	header("Location: index.php?a=".$_GET['a']."&admin");
	exit();
?>