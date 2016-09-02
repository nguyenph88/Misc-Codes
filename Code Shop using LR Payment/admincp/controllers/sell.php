<?php
if (!defined('IN_CODE')) die("Hacking attempt");
$data = array();
$query = 'SELECT username, buy_what, total, `when` FROM crd_raw';
$sql->query($query);
if ($sql->rows() != 0) {
	while ($d = $sql->fetch()) {
		$data[] = $d;
	}
	$tpl->data = $data;
}
$tpl->display(TPL_DIR . 'sell.tpl.php');
?>