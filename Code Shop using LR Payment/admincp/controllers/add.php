<?php
if (!defined('IN_CODE')) die("Hacking attempt");
include 'cfg.php';
if(empty($_POST)) {
	$tpl->cardType = $cardType;
	$tpl->display(TPL_DIR . 'form-add.tpl.php');
} else {
	$card = trim($_POST['cards']);
	$card_type_id = $_POST['card_type_id'];
	$time = time() + 7 * 3600;
	$time = date('Y-m-d H:i:s', $time);
	$tmp = explode("\n", $card);
	$total = 1;
	if(is_array($tmp))
		$total = count($tmp);
	$values = '';
	foreach($tmp as $value) {
		$value = trim($value);
		$value = explode(',', $value);
		$serial = $view->encode( $value[0] );
		$pin = $view->encode( $value[1] );
		$values .= "('', '{$serial}', '{$pin}', 0, 0, '{$card_type_id}', '{$time}', '0000-00-00 00:00:00'),";
	}
	$values = substr($values, 0, -1);
	$query = 'INSERT INTO crd_cards VALUE ' . $values;
	if($sql->runQuery($query)) {
		$query = "UPDATE crd_card SET total = total + {$total} WHERE id = {$card_type_id}";
		$sql->runQuery($query);
		$tpl->title = 'Alert';
		$tpl->msg = 'Items have been added successful';
		$tpl->url = 'main.php?act=add';
		$tpl->display(TPL_DIR . 'redirect.tpl.php');
	} else {
		$tpl->title = 'Alert';
		$tpl->msg = 'Fail. Try again';
		$tpl->display(TPL_DIR . 'message.tpl.php');
	}
}
?>