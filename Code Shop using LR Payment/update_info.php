<?php
define('CLASS_DIR', './classes/'     );
define('IN_CODE'  , TRUE             );
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
$view = new View();
$sql = new MySQL();
$cardID = $view->stripTag($_POST['card_id']);
$quantity = $view->stripTag($_POST['quantity']);
$time = $view->stripTag($_POST['time']);
$uid = $view->stripTag($_POST['uid']);
$username = $view->stripTag($_POST['username']);
$hash = md5($username . $time . 'what.the.fuck.you.think.^@*=34Uw)R');
$query = "SELECT lr FROM crd_card WHERE id = {$cardID}";
$sql->query($query);
if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
}
$total = $cardInfo['lr'] * $quantity;
$query = "INSERT INTO crd_transaction VALUE('', '{$username}', '{$uid}', '{$quantity}', '{$cardID}', '{$total}', '{$time}', '{$hash}', '', 0)";
if($sql->runQuery($query))
	echo 'true';
else
	echo 'false';
?>