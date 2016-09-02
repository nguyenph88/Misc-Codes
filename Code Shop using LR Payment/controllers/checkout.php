<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if(empty($_POST)) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Dữ liệu không được gửi đến.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// sql injection
function baocaosu($dirty){
if (get_magic_quotes_gpc()) {
$clean = mysql_real_escape_string(stripslashes($dirty));
}else{
$clean = mysql_real_escape_string($dirty);
}
return $clean;
}
// end

// Lay so luong muon mua
// Strip du lieu gui len, de phong co XSS
$cardID = $view->stripTag($_POST['card_id']);
$quantity = $view->stripTag($_POST['quantity']);
$time = $view->stripTag($_POST['time']);
$uid = $view->stripTag($_POST['uid']);
$username = $view->stripTag($_POST['username']);

$uid = baocaosu($uid);
$username = baocaosu($username);
$cardID =  baocaosu($cardID);
$quantity = baocaosu($quantity);
$time = baocaosu($time);

// Tinh toan hash
$hash = md5($username . $time . 'what.the.fuck.you.think.^@*=34Uw)R');

// Lay thong tin cua card hien tai
$cardInfo = array();
$query = "SELECT name, vnd, lr, total FROM crd_card WHERE id = {$cardID}";
$sql->query($query);

if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
} else {
	$tpl->title = 'Error';
	$tpl->msg = 'This item is not valid.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Tinh tong so tien phai tra
$total = round($cardInfo['lr'] * $quantity / 100,2);

$query = "INSERT INTO crd_transaction VALUE('', '{$username}', '{$uid}', '{$quantity}', '{$cardID}', '{$total}', '{$time}', '{$hash}', '', 0)";
// Khong can kiem tra xem co chen thanh cong hay khong, vi neu khong thanh cong se khong the lay the ra duoc
// Luc do nguoi mua can lien he truc tiep de co the
if(!$sql->runQuery($query)) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Đã xảy ra lỗi khi cập nhật dữ liệu. Vui lòng liên hệ YM mr.kcdoff để được hỗ trợ.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Lay cac thong tin config nhu acc LR, ten shop, security word
$LRInfo = array();
$query = 'SELECT field, value FROM crd_setting WHERE id IN (3,5)';
$sql->query($query);
if($sql->rows() != 0) {
	while($d = $sql->fetch()) {
		$LRInfo[$d['field']] = $d['value'];
	}
}


// So luong the muon mua
$tpl->quantity = $quantity;
// Tong so tien phai tra
$tpl->total = $total;
// ID cua the
$tpl->card_id = $cardID;
// Ten cua the
$tpl->card_name = $cardInfo['name'];
// Tai khoan va cua hang LR
$tpl->lr_account = $LRInfo['lr_account'];
$tpl->lr_store = $LRInfo['lr_store'];
// Du lieu dieu huong
$tpl->success_url = SITE_URL . 'index.php?view=success';
$tpl->fail_url    = SITE_URL . 'index.php?view=fail';
$tpl->status_url  = SITE_URL . 'index.php?view=status';
// Thong tin thanh vien
$tpl->uid = $_SESSION['uid'];
$tpl->username = $_SESSION['username'];
$tpl->email = $_SESSION['email'];
$tpl->time = $time;

// Luu tru thong tin so luong, loai the, tong so tien vao session
$_SESSION['quatity'] = $quantity;
$_SESSION['card_id'] = $cardID;
$_SESSION['total_amt'] = $totalAmt;

// Hien thi form toi LR
$tpl->display(TPL_DIR . 'checkout.tpl.php');
?>