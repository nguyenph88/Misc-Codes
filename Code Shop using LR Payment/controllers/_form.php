<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if(empty($_POST)) {
	$tpl->title = 'Error!';
	$tpl->msg = 'This product empty.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Lay so luong muon mua
$quantity = (int) $view->stripTag($_POST['quantity']);
$cardID   = (int) $view->stripTag($_POST['card_id']);


// Neu so luong nho hon 0 thi xuat ra loi
if($quantity <= 0) {
	$tpl->title = 'Error!';
	$tpl->msg = 'Please choose one item to continue.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Lay thong tin cua card hien tai
$cardInfo = array();

$query = "SELECT name, vnd, lr, total FROM crd_card WHERE id = {$cardID}";

$sql->query($query);

if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
	$cardInfo['lr'] /=  100;
} else {
	$tpl->title = 'Error!';
	$tpl->msg = 'This item not exist.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}


// Dung thong tin vua lay ra duoc so sanh voi so luong
if($quantity > (int) $cardInfo['total']) {
	$tpl->title = 'Error!';
	$tpl->msg = 'Chỉ còn ' . $cardInfo['total'] . ' thẻ.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Tinh toan tong so tien
$totalAmt = $quantity * $cardInfo['lr'];

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
$tpl->total = $totalAmt;
// ID cua the
$tpl->card_id = $cardID;
// Ten cua the
$tpl->card_name = $cardInfo['name'];
// Tai khoan va cua hang LR
$tpl->lr_account = $LRInfo['lr_account'];
$tpl->lr_store = $LRInfo['lr_store'];
// Du lieu dieu huong
$tpl->success_url = SITE_URL . 'success/';
$tpl->fail_url    = SITE_URL . 'fail/';
$tpl->status_url  = SITE_URL . 'status/';
// Thong tin thanh vien
$tpl->uid = $_SESSION['uid'];
$tpl->username = $_SESSION['username'];

// Lay gio hien tai, server dang dat tai Chicago nen phai +12h de ra gio VN
$time = time() + 12 * 3600;
// Dinh dang lai ngay gio
$time = date('Y-m-d H:i:s', $time);
$tpl->time = $time;

// Luu tru thong tin so luong, loai the, tong so tien vao session
$_SESSION['quatity'] = $quantity;
$_SESSION['card_id'] = $cardID;
$_SESSION['total_amt'] = $totalAmt;

// Chen log dang raw vao db

$tpl->display(TPL_DIR . 'form.tpl.php');

?>