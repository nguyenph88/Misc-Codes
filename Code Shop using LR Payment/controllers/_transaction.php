<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if (!$isLoggedIn) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Bạn chưa đăng nhập.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

$items = array();

$query = "SELECT serial, pin, sold_date FROM crd_cards WHERE sold = 1 AND sold_to = {$_SESSION['uid']}";
$sql->query($query);
if ($sql->rows() != 0) {
	while ($d = $sql->fetch()) {
		$d['sold_date'] = date('d-m-Y H:i:s', strtotime($d['sold_date']));
		$items[] = $d;
	}
	$tpl->items = $items;
	$tpl->display(TPL_DIR . 'transaction.tpl.php');
} else {
	$tpl->title = 'Thông tin!';
	$tpl->msg = 'Không có giao dịch nào.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
}
?>