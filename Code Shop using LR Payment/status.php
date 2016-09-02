<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , './libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
define('SITE_URL' , 'http://vnzid.net/sell');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
require_once CLASS_DIR . 'user.class.php';
require_once LIBS_DIR  . 'Savant3.php';
$tpl  = new Savant3();
$sql  = new MySQL();
$view = new View();
$user = new Users();
$isLoggedIn = $user->checkLogin();
$tpl->isLoggedIn = $isLoggedIn;
$LRInfo = array();
$query = 'SELECT field, value FROM crd_setting WHERE id IN (3,4,5)';
$sql->query($query);
if($sql->rows() != 0) {
	while($d = $sql->fetch()) {
		$LRInfo[$d['field']] = $d['value'];
	}
}
$cucshit = $_REQUEST['lr_encrypted'];
$vip = 'LR : '.$cucshit.'|'.$baishit;
$f = fopen('check24h.txt', 'w');
if (!$f) {
echo 'Error when opening file';
exit(0);
}
if(!fwrite($f, $vip))
echo 'Error when writing file';
else
echo 'Successed';
fclose($f);
$username = $_REQUEST['username'];
$ahash = md5($username . $_REQUEST['time'] . 'what.the.fuck.you.think.^@*=34Uw)R');
$query = "SELECT username, uid, quantity, card_type_id FROM crd_transaction WHERE hash = '{$ahash}' AND sold = 0";
$sql->query($query);
if($sql->rows() != 0) {
	$order = $sql->fetch();
} else {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Không có đơn hàng này.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}
$query = "SELECT lr FROM crd_card WHERE id = {$order['card_type_id']}";
$sql->query($query);
if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
}
$total = $cardInfo['lr'] / 100 * $order['quantity'];
$str = 
  $LRInfo['lr_account']. ':' .
  $_REQUEST['lr_paidby']. ':' .
  $LRInfo['lr_store']. ':' .
  $total. ':' .
  $_REQUEST['lr_transfer']. ':' .
  $_REQUEST['lr_currency']. ':' .
  $LRInfo['lr_sword'];
$hash = strtoupper(bin2hex(mhash(MHASH_SHA256, $str)));
if (isset($_REQUEST['lr_paidto']) && ($_REQUEST['lr_paidto'] == strtoupper($LRInfo['lr_account'])) && isset($_REQUEST['lr_amnt']) && ($_REQUEST['lr_amnt'] == $total) &&  ($_REQUEST['lr_encrypted'] == $hash)) {
	$items = array();
	$id = '';
$query = "UPDATE crd_transaction SET sold = 1,  hash_by_lr = '{$_REQUEST['lr_encrypted']}' WHERE hash = '{$ahash}'";
if(!$sql->runQuery($query)) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}
	$day = substr($_REQUEST['lr_timestamp'], 5, 2);
	$month = substr($_REQUEST['lr_timestamp'], 8, 2);
	$_REQUEST['lr_timestamp'] = str_replace($day . '-' . $month, $month . '-' . $day, $_REQUEST['lr_timestamp']);
	$query = 'SELECT crd_card.name, crd_cards.id, crd_cards.serial, crd_cards.pin FROM crd_cards, crd_card WHERE card_type_id = ' . $order['card_type_id'] . ' AND sold = 0 AND crd_card.id = crd_cards.card_type_id LIMIT 0,' . $order['quantity'];
	$sql->query($query);
	$n = $sql->rows();
	if($n != 0) {
		$mailMsg = '';
			while($d = $sql->fetch()) {
			$id .= $d['id'] . ',';
			$mailMsg .= '--------------------------------------<br />';
			$mailMsg .= 'Loại thẻ: ' . $d['name'] . '<br />';
			$mailMsg .= 'Serial: ' . $d['serial'] . '<br />';
			$mailMsg .= 'PIN: ' . $d['pin'] . '<br />';
			$items[] = $d;
		}
		$mail_mesg = <<< HTML
Chào bạn {$_REQUEST['username']},<br />
Bạn đã mua {$order['quantity']} thẻ ở VNZid.Net. Sau đây là thông tin chi tiết.<br />
{$mailMsg}
--------------------------------------<br />
Cám ơn bạn đã sử dụng dịch vụ của chúng tôi.<br />
======================================<br />
vnzid.net/sell<br />
HTML;
		$id = substr($id, 0, -1);
		$query = "UPDATE crd_cards SET sold = 1, sold_to = {$order['uid']}, sold_date = '{$_REQUEST['lr_timestamp']}' WHERE id IN ({$id})";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}
		$query = "UPDATE crd_card SET total = total - {$order['quantity']} WHERE id = {$order['card_type_id']}";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}
		$query = "INSERT INTO crd_logs VALUES('', '{$_REQUEST['lr_paidby']}', {$order['quantity']}, {$order['card_type_id']}, '{$_REQUEST['lr_transfer']}', '{$_REQUEST['lr_timestamp']}')";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}
	} else {
	$mail_mesg = <<< HTML
Xin lỗi bạn, nhưng hiện tại chúng tôi chỉ còn {$n} thẻ. Có thể ai đó đã mua trước bạn. Vui lòng liên hệ YM harry.potter479 để được giải quyết.
HTML;
	}
$mail_to = $_REQUEST['email'];
$mail_from = 'harry.potter479@yahoo.com.vn';
$mail_sub = 'Thông tin';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
$headers .= 'From: <'.$mail_from.'>' . "\r\n";
	mail($mail_to, $mail_sub, $mail_mesg, $headers);
}
$query = "UPDATE crd_transaction SET hash_by_lr = '{$_REQUEST['lr_encrypted']}' WHERE hash = '{$ahash}'";
if($sql->runQuery($query))
	echo 'ok';
else
	echo 'no';
?>