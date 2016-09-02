<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , './libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Get needed classes
require_once CLASS_DIR . 'mysql.class.php';
require_once LIBS_DIR  . 'Savant3.php';

$sql  = new MySQL();
$tpl  = new Savant3();

if(empty($_GET['card'])) {
	$tpl->title = 'Lỗi!';
	$tpl->msg = 'Truy cập không hợp lệ.';
	$tpl->display(TPL_DIR . 'message.tpl.php');
}

$output = '';

$query = "SELECT id, name, category, lr, total, image FROM crd_card WHERE category = '{$_GET['card']}' ORDER BY lr ASC";
$sql->query($query);
$n = 0;
if($sql->rows() != 0) {
		$output .= <<< HTML
<table width="720" cellpadding="2" cellspacing="5" border="0" class="card">
	<tr>
HTML;
	while($d = $sql->fetch()) {
		$d['lr'] = $d['lr'] / 100;
		$output .= <<< HTML
<td align="left">
	<center><strong>{$d['name']}</strong><br />
	<img src="{$d['image']}" alt="{$d['name']}" width="200" /></center>
	Giá: <strong>{$d['lr']}</strong> LR<br />
	Hiện đang có <strong>{$d['total']}</strong> thẻ<br />
	<form id="cardBuying" name="cardBuying" method="post" action="./form/">
	Số lượng: <input type="text" value="1" name="quatity" id="txtQuatity{$d['id']}" style="width: 20px;" />
	<input type="hidden" id="txtCardID{$d['id']}" name="card_id" value="{$d['id']}" />
	<input type="hidden" id="txtTotal{$d['id']}" name="txtTotal" value="{$d['total']}" />
	<input type="hidden" name="lr_value" value="{$d['lr']}" />
	<input type="hidden" name="card_name" value="{$d['name']}" />
	<input type="hidden" id="txtID" value="{$d['id']}" />
	<input type="submit" value="Mua" />
	</form>
</td>
HTML;
		$n++;
		if($n % 2 == 0) {
		$output .= "\n</tr>\n<tr>\n";
		}
	}
		$output .= <<< HTML
	</tr>
</table>
	<script type="text/javascript">
$(document).ready(function(){
	this.sendData = function(id) {
		quatity = $("#txtQuatity" + id).val();
		card_id = $("#txtCardID" + id).val();
		total = $("#txtTotal" + id).val();
		quatity = parseInt(quatity);
		if(quatity < 0) {
			alert("Xin lỗi bồ, nhưng nhập số âm vô là sao?! :-w");
			return false;
		}
		if(quatity > total) {
			alert("Xin lỗi bồ, nhưng hiện tại chúng tôi chỉ còn " + total + " thẻ.");
			return false;
		}
		return true;
		
		/*
		$("#cartLoading").show();
		$("#tblCart").remove();
		$("#cart").load("index.php?view=cart", { 'data[]': [quatity, card_id] }, function() {
			$("#cartLoading").hide();
		});

		alert("Bồ mua " + quatity + " thẻ loại" + card_id);
		*/
	};
	
	$("#cardBuying").submit(function() {
		id = $("#txtID").val();
		quatity = $("#txtQuatity" + id).val();
		card_id = $("#txtCardID" + id).val();
		total = $("#txtTotal" + id).val();
		quatity = parseInt(quatity);
		if(quatity < 0) {
			alert("Xin lỗi bồ, nhưng nhập số âm vô là sao?! :-w");
			return false;
		}
		if(quatity > total) {
			alert("Xin lỗi bồ, nhưng hiện tại chúng tôi chỉ còn " + total + " thẻ.");
			return false;
		}
		return true;
	});
});
	</script>
HTML;
} else {
	$output .= '<center>Sorry. This catalog dont have any items.Please try again next time.<br> Thank you.</center>';
}

	echo $output;
?>