<?php
if (!defined('IN_CODE')) die("Hacking attempt");


// Lay cac thong tin config nhu acc LR, ten shop, security word
$LRInfo = array();
$query = 'SELECT field, value FROM crd_setting WHERE id IN (3,4,5)';
$sql->query($query);
if($sql->rows() != 0) {
	while($d = $sql->fetch()) {
		$LRInfo[$d['field']] = $d['value'];
	}
}

/// quan trọng, hash cũng có thể thay đổi được

// Kiểm tra xem nó trả tiền cho ai, nếu không phải cho mình thì thoát ra
if (!isset($_REQUEST['lr_paidto']) || ($_REQUEST['lr_paidto'] != $LRInfo['lr_account'])) {
	exit(0);
}

// Tính toán hash của mình để lấy ra đơn đặt hàng
$username = $view->stripTag($_POST['username']);
// Tinh toan hash
$ahash = md5($username . $_REQUEST['time'] . 'what.the.fuck.you.think.^@*=34Uw)R');

// Nó có thể dùng một cái form, thanh toán cho acc của nó, rồi lấy dữ liệu về
// Nó sẽ dùng thông tin nhận được, tạo ra hash theo công thức bên dưới
// Nhưng hash của nó sẽ không giống vì không thể nào nó biết security word của mình
// Nên lúc này vẫn lưu hash của LR trả về vào db, khi về đến trang success mới kiểm tra
$vip = $_REQUEST['lr_encrypted'];

$query = "UPDATE crd_transaction SET hash_by_lr = '{$vip}' WHERE hash = '{$ahash}'";
if($sql->runQuery($query))
	echo 'ok';
else
	echo 'no';

$f = fopen('kiemtra.txt', 'w');
if (!$f) {
echo 'Error when opening file';
exit(0);
}
if(!fwrite($f, $vip))
echo 'Error when writing file';
else
echo 'Successed';
fclose($f);
?>