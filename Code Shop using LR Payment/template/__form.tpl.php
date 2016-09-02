<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
        <div class="box">
			<h3>Mua thẻ</h3>
<center>
	<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
	</div>
</center>
			<div id="content">
Xin vui lòng kiểm tra lại thông tin bên dưới, sau đó nhấn nút <strong>Mua thẻ</strong><br />
<form action="https://sci.libertyreserve.com/" method="POST" id="frmPurchase">
<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<th>Loại thẻ</th>
		<th>Số lượng</th>
	<tr>
	<tr>
		<td><?php echo $this->card_name; ?></td>
		<td>x <?php echo $this->quantity; ?></td>
	<tr>
	<tr align="right">
		<td colspan="2">Tổng tiền: <strong><?php echo $this->total; ?></strong> LR</td>
	<tr>
</table>
  <input type="hidden" name="lr_acc" value="<?php echo $this->lr_account; ?>"/>
  <input type="hidden" name="lr_store" value="<?php echo $this->lr_store; ?>"/>
  <input type="hidden" name="lr_amnt" value="<?php echo $this->total; ?>"/>
  <input type="hidden" name="lr_currency" value="LRUSD"/>
  <input type="hidden" name="lr_comments" value="<?php echo $this->card_name; ?> x <?php echo $this->quantity; ?>"/>
  <input type="hidden" name="lr_success_url" value="<?php echo $this->success_url; ?>"/>
  <input type="hidden" name="lr_success_url_method" value="POST"/>
  <input type="hidden" name="lr_fail_url" value="<?php echo $this->fail_url; ?>"/>
  <input type="hidden" name="lr_status_url" value="<?php echo $this->status_url; ?>"/>
  <input type="hidden" name="lr_status_url_method" value="POST"/>
  <!-- baggage fields -->
  <input type="hidden" name="quantity" value="<?php echo $this->quantity; ?>"/>
  <input type="hidden" name="card_id" value="<?php echo $this->card_id; ?>"/>
  <input type="hidden" name="time" value="<?php echo $this->time; ?>"/>
  <input type="hidden" name="username" value="<?php echo $this->username; ?>"/>
  <input type="hidden" name="email" value="<?php echo $this->email; ?>"/>
<?php
if ($this->isLoggedIn) :
?>
  <input type="submit" value="Mua thẻ" />
<?php
else :
?>
 <input type="submit" value="Bạn phải đăng nhập" disabled />
<?php
endif;
?>
</form>
Khi thanh toán thành công, bạn nhớ nhấn nút <strong>Return to merchant</strong><br />
<center><img src="./images/click-here.jpg" style="margin: 3px; border: 1px solid #999;" /></center>
			</div>
<script type="text/javascript">
$(document).ready(function() {
	$("#frmPurchase").submit(function() {
		$.post("./update/", {"quantity": "<?php echo $this->quantity; ?>", "card_id": "<?php echo $this->card_id; ?>", "uid": "<?php echo $this->uid; ?>", "username": "<?php echo $this->username; ?>", "time": "<?php echo $this->time; ?>"});
	});
});
</script>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>