<?php
if (!defined('IN_CODE')) die("Hacking attempt");
if(empty($_POST)) {
	$data = array();
	$query = 'SELECT id, name, lr, total FROM crd_card';
	$sql->query($query);
	if($sql->rows() != 0) {
		while($d = $sql->fetch()) {
			$d['lr'] = $d['lr'] / 100;
			$data[] = $d;
		}
	}
	$tpl->data = $data;
	$tpl->display(TPL_DIR . 'editcard.tpl.php');
}
?>