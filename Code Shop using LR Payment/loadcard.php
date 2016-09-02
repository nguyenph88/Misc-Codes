<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , './libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
// Get needed classes
require_once CLASS_DIR . 'mysql.class.php';
$sql  = new MySQL();
if(empty($_GET['card'])) {
	die("Your request not valid now.");
}
$output = '';
$query = "SELECT id, name, lr, total, image FROM crd_card WHERE category = '{$_GET['card']}' ORDER BY lr ASC";
$sql->query($query);
$n = 0;
if($sql->rows() != 0) {
		$output .= <<< HTML
<table width="720" cellpadding="2" cellspacing="5" border="0" class="card">
	<tr>
HTML;
	while($d = $sql->fetch()) {
		// Chia ra tinh gia tri thuc cua LR
		$d['lr'] = $d['lr'] / 100;
		// Tinh so the cho phep mua 1 lan
		$max = 10;
		if ($d['total'] < $max) {
			$max = $d['total'];
		}
		$dropdown = '';
		// Tao dropdown box
		for($i = 1; $i <= $max; ++$i) {
			$dropdown .= <<< HTML
<option value="$i">{$i}</option>\n
HTML;
		}
		$output .= <<< HTML
<td align="center">
	<center><strong>{$d['name']}</strong><br />
	<img src="{$d['image']}" alt="{$d['name']}" width="119" heigh="150"/></center>
	Price: <strong><span style="font-size: 1.3em;">{$d['lr']}</span></strong> LR<br />
	In Stock <strong><span style="font-size: 1.7em; color: red;">{$d['total']}</span></strong> items<br />
	<form id="cardBuying" name="cardBuying" method="post" action="index.php?view=form">
		 Quantity:
		<select name="quantity">
			{$dropdown}
		</select>
		<input type="hidden" name="card_id" value="{$d['id']}" />
		<input type="submit" value="Order" />
	</form>
</td>
HTML;
		// 2 the mot hang
		$n++;
		if($n % 2 == 0) {
		$output .= "\n</tr>\n<tr>\n";
		}
	}
		$output .= <<< HTML
	</tr>
</table>
HTML;
} else {
	$output .= '
<center>Sorry. This catalog dont have any items.Please try again next time.<br>
Please click here to choose another items.<br>
Thank you for your visit <a href="http://vnzid.net/sell">VNZid.Net</a><br>
<a href="?"><img src="/images/public.gif" width="750" height="100%"/></a></center>
';
}
	echo $output;
?>