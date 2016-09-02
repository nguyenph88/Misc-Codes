<?php
if (!defined('IN_CODE')) die("Hacking attempt");

if(empty($_POST)) {
	$tpl->title = 'Error';
	$tpl->msg = 'Your order current not select any items.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Lay so luong muon mua
$quantity = (int) $view->stripTag($_POST['quantity']);
$cardID   = (int) $view->stripTag($_POST['card_id']);


// Neu so luong nho hon 0 thi xuat ra loi
if($quantity <= 0) {
	$tpl->title = 'Error';
	$tpl->msg = 'Current item not equal 0.';
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

$cardID = baocaosu($cardID);

// Lay thong tin cua card hien tai
$cardInfo = array();
$query = "SELECT name, vnd, lr, total FROM crd_card WHERE id = {$cardID}";
$sql->query($query);

if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
	$cardInfo['lr'] /=  100;
} else {
	$tpl->title = 'Error';
	$tpl->msg = 'This items not exist.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}


// Dung thong tin vua lay ra duoc so sanh voi so luong
if($quantity > (int) $cardInfo['total']) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Chỉ còn ' . $cardInfo['total'] . ' thẻ.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}

// Tinh toan tong so tien
$totalAmt = $quantity * $cardInfo['lr'];

// So luong the muon mua
$tpl->quantity = $quantity;
// Tong so tien phai tra
$tpl->total = $totalAmt;
// ID cua the
$tpl->card_id = $cardID;
// Ten cua the
$tpl->card_name = $cardInfo['name'];
// Thong tin thanh vien
$tpl->uid = $_SESSION['uid'];
$tpl->username = $_SESSION['username'];
$tpl->email = $_SESSION['email'];

// Lay gio hien tai, server dang dat tai Chicago nen phai +12h de ra gio VN
$time = time() + 12 * 3600;
// Dinh dang lai ngay gio
$time = date('Y-m-d H:i:s', $time);
$tpl->time = $time;

$tpl->display(TPL_DIR . 'form.tpl.php');

?>