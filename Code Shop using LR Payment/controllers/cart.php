<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if(empty($_POST)) {
	$tpl->title = 'Error!';
	$tpl->msg = 'Please choose one item';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

$_POST['data'][1] = $view->stripTag($_POST['data'][1]);

$quatity = $_POST['data'][0];
$card_id = $_POST['data'][1];

// check if the card is empty
if(isset($_SESSION['data'])) {
	$_SESSION['data'] .=  $card_id . ',' . $quatity .'|';
} else {
	$_SESSION['data'] =  $card_id . ',' . $quatity .'|';
}

$tpl->cart = $cart->processItems($_SESSION['data']);
$tpl->display(TPL_DIR . 'singlecart.tpl.php');
?>