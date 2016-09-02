<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , '../libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
$sql  = new MySQL();
$mode = $_GET['mode'];
if($mode == 'today') {
	$time = date('Y-m-d', time());
} else if ($mode == 'yesterday') {
	$time = time() - 24 * 3600;
	$time = date('Y-m-d', $time);
} else if ($mode == 'month'){
	$time = date('Y-m', time());
} else if ($mode == 'date') {
	$day   = (isset($_GET['day']))   ? $_GET['day']   : '';
	$month = (isset($_GET['month'])) ? $_GET['month'] : '';
	$year  = (isset($_GET['year']))  ? $_GET['year']  : '';
	$time = $year . '-' . $day . '-' . $month;
	if($time == $year .'--')
		$time = $year;
}
$output = '';
	$query = "SELECT crd_logs.buyer, crd_logs.quatity, crd_logs.transaction_id, crd_logs.purchase_date, crd_card.name FROM crd_card, crd_logs WHERE crd_logs.card_id = crd_card.id AND crd_logs.purchase_date LIKE '%{$time}%'";
	$sql->query($query);
	if($sql->rows() != 0) {
		$output .= <<< HTML
<table width="100%" cellpadding="2" cellspacing="2">
	<tr>
		<th>Người mua</th>
		<th>Loại thẻ</th>
		<th>Số lượng</th>
		<th>Transaction ID</th>
		<th>Ngày giao dịch</th>
	</tr>
HTML;
		while($d = $sql->fetch()) {
			$output .= <<< HTML
	<tr>
		<td>{$d['buyer']}</td>
		<td>{$d['name']}</td>
		<td>{$d['quatity']}</td>
		<td>{$d['transaction_id']}</td>
		<td>{$d['purchase_date']}</td>
	</tr>
HTML;
		}
	} else {
		$output .= 'Không có giao dịch.';
	}
echo $output;
?>