<?php
if (!defined('IN_CODE')) die("Hacking attempt");
include 'cfg.php';
$tpl->cardType = $cardType;
$id = $_GET['id'];
if(!empty($_POST)) {
	$query = "UPDATE crd_card SET name = '{$_POST['name']}', vnd = '{$_POST['vnd']}', lr = '{$_POST['lr']}', image = '{$_POST['image']}' WHERE id = {$id}";
	if(!$sql->runQuery($query)) {
		$tpl->title = 'Lỗi!';
		$tpl->msg = 'Lỗi khi cập nhật dữ liệu, vui lòng thử lại';
		$tpl->display(TPL_DIR . 'message.tpl.php');
	} else {
		$tpl->title = 'Thông báo!';
		$tpl->msg = 'Cập nhật dữ liệu thành công.';
		$tpl->url = 'main.php';
		$tpl->display(TPL_DIR . 'redirect.tpl.php');
	}	
} else {
	$query = "SELECT name, category, vnd, lr, image FROM crd_card WHERE id = {$id}";
	$sql->query($query);
	if ($sql->rows() != 0) {
		$d = $sql->fetch();
		$tpl->id = $id;
		$tpl->name = $d['name'];
		$tpl->catogory = $d['category'];
		$tpl->vnd = $d['vnd'];
		$tpl->lr = $d['lr'];
		$tpl->image = $d['image'];
		$tpl->display(TPL_DIR . 'form-edit.tpl.php');
	}
}
?>