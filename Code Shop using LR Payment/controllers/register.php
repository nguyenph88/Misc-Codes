<?php
if (!defined('IN_CODE')) die("Hacking attempt");
if(!empty($_POST)) {
	$username = $view->stripTag($_POST['txtUsername']);
	$email = $view->stripTag($_POST['txtEmail']);
	$pw = $view->stripTag($_POST['txtPW1']);
	$captcha = $view->stripTag($_POST['txtCaptcha']);
function baocaosu($dirty){
if (get_magic_quotes_gpc()) {
$clean = mysql_real_escape_string(stripslashes($dirty));
}else{
$clean = mysql_real_escape_string($dirty);
}
return $clean;
}
$username = baocaosu($username);
$email = baocaosu($email);
$pw = baocaosu($pw);
$captcha = baocaosu($captcha);
	if (($_POST['txtCaptcha'] != $_SESSION['captcha_register']) || empty($_SESSION['captcha_register'])) {
		$tpl->title = 'Lỗi!';
		$tpl->msg = 'Mã bảo vệ sai!';
		$tpl->display(TPL_DIR . 'message.tpl.php');
		exit(0);
	}
	$query = "SELECT id FROM crd_users WHERE username = '{$username}' OR email = '{$email}'";
	$sql->query($query);
	if ($sql->rows() != 0) {
		$tpl->title = 'Lỗi!';
		$tpl->msg = 'Tên truy cập hoặc email đã được sử dụng. Vui lòng kiểm tra lại.';
		$tpl->display(TPL_DIR . 'message.tpl.php');
		exit(0);
	}
	$pw = md5(md5($pw) . 'what.the.fuck.is.going.on?!');
	$query = "INSERT INTO crd_users VALUES ('', '{$username}', '{$pw}', '{$email}')";
	if($sql->runQuery($query)) {
		$tpl->title = 'Thông báo';
		$tpl->msg = 'Đăng ký thành công. Vui lòng đăng nhập với username và password đã chọn.';
		$tpl->url = SITE_URL . 'index.php';
		$tpl->display(TPL_DIR . 'redirect.tpl.php');
	} else {
		$tpl->title = 'Lỗi!';
		$tpl->msg = 'Đã xảy ra lỗi khi thực hiện đăng ký, vui lòng thử lại.';
		$tpl->display(TPL_DIR . 'message.tpl.php');
	}
} else {
	$tpl->display(TPL_DIR . 'register.tpl.php');
}
?>