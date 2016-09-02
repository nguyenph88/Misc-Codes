<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if (!$isLoggedIn) {
	$tpl->title = 'Error';
	$tpl->msg = 'You are not login yet.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

$items = array();

$query = "SELECT crd_card.name, crd_cards.serial, crd_cards.pin, crd_cards.sold_date FROM crd_cards, crd_card WHERE crd_cards.card_type_id = crd_card.id AND crd_cards.sold = 1 AND crd_cards.sold_to = {$_SESSION['uid']} ORDER BY crd_cards.sold_date DESC";
$sql->query($query);
if ($sql->rows() != 0) {
	while ($d = $sql->fetch()) {
		$d['sold_date'] = date('d-m-Y H:i:s', strtotime($d['sold_date']));
		$items[] = $d;
	}
	$tpl->items = $items;
	$tpl->display(TPL_DIR . 'transaction.tpl.php');
} else {
	$tpl->title = 'Your payment status';
	$tpl->msg = 'Current your account dont have any Orders.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
}
?>