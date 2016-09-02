<?php
if (!defined('IN_CODE')) die("Hacking attempt");
if(empty($_POST)) {
	$tpl->title = 'Error!';
	$tpl->msg = 'Database not exist.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

$username = $view->stripTag($_POST['txtUserName']);
$pw       = $view->stripTag($_POST['txtPassword']);
$captcha  = $view->stripTag($_POST['txtCaptcha']);


// sql injection
function baocaosu($dirty){
if (get_magic_quotes_gpc()) {
$clean = mysql_real_escape_string(stripslashes($dirty));
}else{
$clean = mysql_real_escape_string($dirty);
}
return $clean;
}
// end

$username = baocaosu($username);


if (($_POST['txtCaptcha'] != $_SESSION['captcha_login']) || empty($_SESSION['captcha_login'])) {
	$tpl->title = 'Error';
	$tpl->msg = 'Please enter correct security code';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Check if this email or username existed in database
$pw = md5(md5($pw) . 'what.the.fuck.is.going.on?!');
$query = "SELECT id, email FROM crd_users WHERE username = '{$username}' AND password = '{$pw}'";
$sql->query($query);
if ($sql->rows() != 0) {
	$d = $sql->fetch();
	$_SESSION['uid'] = $d['id'];
	$_SESSION['email'] = $d['email'];
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $pw;
	$tpl->title = 'Alert!';
	$tpl->msg = 'Logon success!';
	$tpl->url = SITE_URL . 'index.php';
	$tpl->display(TPL_DIR . 'redirect.tpl.php');
} else {
	$tpl->title = 'Error!';
	$tpl->msg = 'Username not exist.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}
?>