<?php
if (!defined('IN_CODE')) die("Hacking attempt");
$query = "SELECT value FROM crd_setting WHERE field = 'lr_exchange'";
$sql->query($query);
$d = $sql->fetch();
$msg = '';
$exchange = $d['value'];
$query = "SELECT id, name, vnd, lr FROM crd_card";
$sql->query($query);
if($sql->rows() != 0) {
	while($d = $sql->fetch()) {
		$lr = round($d['vnd'] / $exchange, 2) * 100;
		$d['lr'] = $d['lr'] / 100;
		$query = "UPDATE crd_card SET lr = {$lr} WHERE id = {$d['id']}";
		$sql->runQuery($query);
		$newLR = $lr / 100;
		$msg .= "Updated {$d['name']} from <strong>{$d['lr']}</strong> to <strong>{$newLR}</strong><br />";
	}
}
$tpl->title = 'Alert';
$tpl->msg = $msg;	
$tpl->display(TPL_DIR . 'message.tpl.php');
?>