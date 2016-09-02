<?php
if (!defined('IN_CODE')) die("Hacking attempt");
include 'cfg.php';
if(empty($_POST)) {
	$tpl->cardType = $cardType;
	$tpl->display(TPL_DIR . 'form-subcard.tpl.php');
} else {
	$query = "INSERT INTO crd_card VALUE ('', '{$_POST['cardName']}', '{$_POST['category']}', '{$_POST['vnd']}', '{$_POST['lr']}', 0, '{$_POST['image']}')";
	if($sql->runQuery($query)) {
		$tpl->title = 'Thông báo';
		$tpl->msg = 'Thêm card thành công.';
		$tpl->url = 'main.php?act=subcard';
		$tpl->display(TPL_DIR . 'redirect.tpl.php');
	} else {
		$tpl->title = 'Thông báo';
		$tpl->msg = 'Thất bại. Thử lại';
		$tpl->display(TPL_DIR . 'message.tpl.php');
	}
}
?>