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


// Lấy thông tin đơn hàng
$username = $_POST['username'];
// Tinh toan hash
$ahash = md5($username . $_POST['time'] . 'what.the.fuck.you.think.^@*=34Uw)R');

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

$ahash = baocaosu($ahash);

// Lấy thông tin mua hàng của thằng có hash bằng ahash và đơn hàng chưa được thanh toán
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



// Tính toán tổng tiền cho đơn đặt hàng này
// Lay gia tien cua loai the muon mua

$query = "SELECT lr FROM crd_card WHERE id = {$order['card_type_id']}";
$sql->query($query);
if ($sql->rows() != 0) {
	$cardInfo = $sql->fetch();
}

// Tinh tong so tien phai tra
$total = round($cardInfo['lr'] / 100 * $order['quantity'],2);

// Đoạn hash dùng để so sánh lần giao dịch trên LR
$str = 
  $LRInfo['lr_account']. ':' .
  $_POST['lr_paidby']. ':' .
  $LRInfo['lr_store']. ':' .
  $total. ':' .
  $_POST['lr_transfer']. ':' .
  $_POST['lr_currency']. ':' .
  $LRInfo['lr_sword'];


// Tính toán hash
$hash = strtoupper(bin2hex(mhash(MHASH_SHA256, $str)));

/*
$cucshit = $_POST['lr_encrypted'];
$vip = 'lr hash : '.$cucshit.'</br>id: '.$ahash.'</br>my hash: '.$hash.'</br>lr account: '.$LRInfo['lr_account'].
'</br>store: '.$LRInfo['lr_store'].'</br>total: '.$total.'</br>security: '.$LRInfo['lr_sword'];


$f = fopen('kiemtra.htm', 'w');
if (!$f) {
echo 'Error when opening file';
exit(0);
}
if(!fwrite($f, $vip))
echo 'Error when writing file';
else
echo 'Successed';
fclose($f);

*/

// Kiểm tra xem nó trả tiền cho ai, nếu không phải cho mình thì thoát ra
if (isset($_POST['lr_paidto']) && ($_POST['lr_paidto'] == strtoupper($LRInfo['lr_account'])) && isset($_POST['lr_amnt']) && ($_POST['lr_amnt'] == $total) &&  ($_POST['lr_encrypted'] == $hash)) {
	// Tức là thanh toán thành công, tiến hành các thủ tục xuất thẻ
	
	// Biến $items dùng để lưu thông tin thẻ
	$items = array();
	// ID dùng để lưu id của những thẻ đã bán
	$id = '';
	
//================================
// Cập nhật thông tin trước
//================================

// Cập nhật đơn hàng này đã được thực hiện, đồng thời set hash LR luôn
$query = "UPDATE crd_transaction SET sold = 1,  hash_by_lr = '{$_POST['lr_encrypted']}' WHERE hash = '{$ahash}'";
if(!$sql->runQuery($query)) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
	exit(0);
}
	
	// Định dạng timestamp của LR thành YYYY-MM-DD
	$day = substr($_POST['lr_timestamp'], 5, 2);
	$month = substr($_POST['lr_timestamp'], 8, 2);
	$_POST['lr_timestamp'] = str_replace($day . '-' . $month, $month . '-' . $day, $_POST['lr_timestamp']);

	// Tạo câu lệnh, lấy tên thẻ, id của thẻ, số serial và pin
	$query = 'SELECT crd_card.name, crd_cards.id, crd_cards.serial, crd_cards.pin FROM crd_cards, crd_card WHERE card_type_id = ' . $order['card_type_id'] . ' AND sold = 0 AND crd_card.id = crd_cards.card_type_id LIMIT 0,' . $order['quantity'];
	// Chạy lệnh query
	$sql->query($query);
	// Lấy tổng số thẻ có trong db
	$n = $sql->rows();
	// Nếu còn thẻ trong db
	if($n != 0) {
		$mailMsg = '';
		
		while($d = $sql->fetch()) {
			// Tạo chuỗi (id1, id2, id3) id của các thẻ sẽ show
			$id .= $d['id'] . ',';
			$mailMsg .= '--------------------------------------<br />';
			$mailMsg .= 'Loại thẻ: ' . $d['name'] . '<br />';
			$mailMsg .= 'Serial: ' . $view->decode($d['serial']) . '<br />';
			$mailMsg .= 'PIN: ' . $view->decode($d['pin']) . '<br />';
			$items[] = $d;
		}
		
		$mail_mesg = <<< HTML
Chào bạn {$_POST['username']},<br />
Bạn đã mua {$order['quantity']} thẻ ở VNZid.Net. Sau đây là thông tin chi tiết.<br />
{$mailMsg}
--------------------------------------<br />
Cám ơn bạn đã sử dụng dịch vụ của chúng tôi.<br />
======================================<br />
MuaTheGame.com<br />
HTML;
		
		// Xóa dấu , cuối cùng
		$id = substr($id, 0, -1);
		
		// Cập nhật lại các thẻ này đã được bán rồi
		$query = "UPDATE crd_cards SET sold = 1, sold_to = {$order['uid']}, sold_date = '{$_POST['lr_timestamp']}' WHERE id IN ({$id})";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}
		
		// Tiếp tục cập nhật tổng số thẻ trừ đi số đã bán
		$query = "UPDATE crd_card SET total = total - {$order['quantity']} WHERE id = {$order['card_type_id']}";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}
		
		// Chèn log vào để quản lý
		$query = "INSERT INTO crd_logs VALUES('', '{$_POST['lr_paidby']}', {$order['quantity']}, {$order['card_type_id']}, '{$_POST['lr_transfer']}', '{$_POST['lr_timestamp']}')";
		if(!$sql->runQuery($query)) {
			$tpl->title = 'Lỗi!';
			$tpl->msg = 'Cập nhật dữ liệu thất bại, vui lòng liên hệ qua YM harry.potter479 để được giải quyết.';
			$tpl->display(TPL_DIR . 'message.tpl.php');
			exit(0);
		}

	// Trường hợp hết thẻ trong db
	} else {
		// Đánh dấu hết thẻ
		$mail_mesg = <<< HTML
Xin lỗi bạn, nhưng hiện tại chúng tôi chỉ còn {$n} thẻ. Có thể ai đó đã mua trước bạn. Vui lòng liên hệ YM harry.potter479 để được giải quyết.
HTML;
	}

//================================
// Gửi mail thông báo
//================================

// Declarate the necessary variables
$mail_to = $_POST['email'];
$mail_from = 'admin@vuzui.net';
$mail_sub = 'Thông tin thẻ game';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
$headers .= 'From: <'.$mail_from.'>' . "\r\n";
	// Gửi mail cho người mua
	mail($mail_to, $mail_sub, $mail_mesg, $headers);
	
}
/*
// Nó có thể dùng một cái form, thanh toán cho acc của nó, rồi lấy dữ liệu về
// Nó sẽ dùng thông tin nhận được, tạo ra hash theo công thức bên dưới
// Nhưng hash của nó sẽ không giống vì không thể nào nó biết security word của mình
// Nên lúc này vẫn lưu hash của LR trả về vào db, khi về đến trang success mới kiểm tra


$query = "UPDATE crd_transaction SET hash_by_lr = '{$_POST['lr_encrypted']}' WHERE hash = '{$ahash}'";
if($sql->runQuery($query))
	echo 'ok';
else
	echo 'no';



*/
?>