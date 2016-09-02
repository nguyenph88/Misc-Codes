<?php
if (!defined('IN_CODE')) die("Hacking attempt");
if(!empty($_POST)) {
	foreach($_POST['field'] as $field => $value) {
		$query = "UPDATE crd_setting SET value = '{$value}' WHERE id = {$field}";
		$sql->runQuery($query);
	}
	$tpl->title = 'Thành công!';
	$tpl->msg = 'Dữ liệu đã được cập nhật!';
	$tpl->url = 'main.php';
	$tpl->display(TPL_DIR . 'redirect.tpl.php');
} else {
	$data = array();
	$query = "SELECT name, id, value FROM crd_setting";
	$sql->query($query);
	if ($sql->rows() != 0) {
		while ($d = $sql->fetch())
			$data[] = $d;
	}
	$tpl->data = $data;
	$tpl->display(TPL_DIR . 'setting.tpl.php');
}
?>