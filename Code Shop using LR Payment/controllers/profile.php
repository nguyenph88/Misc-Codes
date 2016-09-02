<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if (!$isLoggedIn) {
	$tpl->title = 'Error!';
	$tpl->msg = 'You're not login.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}


?>