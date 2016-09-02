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
$output = '';
$offset = $_GET['offset'];
$category = $_GET['category'];
$status = $_GET['status'];
if ($status) {
	$query = "SELECT crd_users.username, crd_card.name, crd_cards.id, crd_cards.serial, crd_cards.pin, crd_cards.sold, crd_cards.added_date, crd_cards.sold_date FROM crd_card, crd_cards, crd_users WHERE crd_cards.card_type_id = crd_card.id AND crd_card.category = '{$category}' AND crd_cards.sold = {$status} AND crd_users.id = crd_cards.sold_to GROUP BY crd_cards.id ORDER BY crd_cards.added_date DESC LIMIT {$offset}, 50";
} else {
	$query = "SELECT crd_card.name, crd_cards.id, crd_cards.serial, crd_cards.pin, crd_cards.sold, crd_cards.added_date, crd_cards.sold_date FROM crd_card, crd_cards, crd_users WHERE crd_cards.card_type_id = crd_card.id AND crd_card.category = '{$category}' AND crd_cards.sold = {$status} GROUP BY crd_cards.id ORDER BY crd_cards.sold_date DESC LIMIT {$offset}, 50";
}
$sql->query($query);
if ($sql->rows() != 0) {
	$output .= <<< HTML
<table width="95%" cellpadding="2" cellspacing="2">
	<tr>
		<th>Loại thẻ</th>
		<th>Serial</th>
		<th>Pin</th>
		<th>Tình trạng</th>
		<th>Ngày thêm</th>
		<th>Ngày bán</th>		
		<th>Bán cho</th>		
	</tr>
HTML;
	while($d = $sql->fetch()) {
		$d['username'] = ($status) ? $d['username'] : '';
		$output .= <<< HTML
	<tr>
		<td><a href="main.php?act=editcrd&amp;id={$d['id']}">{$d['name']}</a></td>
		<td>{$d['serial']}</td>
		<td>{$d['pin']}</td>
		<td><img src="./images/{$d['sold']}.png" /></td>
		<td>{$d['added_date']}</td>
		<td>{$d['sold_date']}</td>
		<td>{$d['username']}</td>
	</tr>
HTML;
	}
	$next = $offset + 50;
	$prev = ($offset - 50 < 0) ? 0 : $offset - 50;
	$output .= <<< HTML
	<tr>
		<td colspan="3"><a onclick="loadCard('{$category}', {$status}, {$prev})">&laquo; 50 kết quả trước</a></td>
		<td colspan="3" align="right"><a onclick="loadCard('{$category}', {$status}, {$next})">50 kết quả kế &raquo;</a></td>
	</tr>
</table>
HTML;
} else {
	$output .= 'Không có';
}
echo $output;
?>