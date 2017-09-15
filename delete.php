<?php
	ignore_user_abort(true);
	unlink($_GET['file']);
	echo 'Deleted. <script>window.close()</script>';
	exit();
?>