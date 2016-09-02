<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if (!$isLoggedIn) {
	$tpl->title = 'Error!';
	$tpl->msg = 'You are not logon.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}
unset($_SESSION['uid']);
unset($_SESSION['username']);
unset($_SESSION['password']);
$tpl->title = 'Alert';
$tpl->msg = 'You will logout now.';
$tpl->url = SITE_URL . 'index.php';
$tpl->display(TPL_DIR . 'redirect.tpl.php');
?>