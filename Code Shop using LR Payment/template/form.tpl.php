<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
        <div class="box">
			<h3>Overview your order</h3>
<center>
	<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
	</div>
</center>
			<div id="content">
				<strong>
			<fieldset><legend>Note</legend>
Please review your order before continue payment.<br>
<i>(You must login for checkout)</i>
			</fieldset>
				</strong><br />
<fieldset><legend>Overview</legend>
	<form action="./index.php?view=checkout" method="POST" id="frmPurchase">
	<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<th>Items</th>
		<th>Quantity</th>
		<th>Total</th>
	<tr>
	<tr>
		<td><?php echo $this->card_name; ?></td>
		<td><b>X</b> <?php echo $this->quantity; ?> item</td>
		<td><strong><?php echo $this->total; ?></strong> LR</td>
	<tr>
	<tr align="right">
	<td colspan="2"><br />
	<tr>
</table>  
  <input type="hidden" name="quantity" value="<?php echo $this->quantity; ?>"/>
  <input type="hidden" name="card_id" value="<?php echo $this->card_id; ?>"/>
  <input type="hidden" name="time" value="<?php echo $this->time; ?>"/>
  <input type="hidden" name="username" value="<?php echo $this->username; ?>"/>
  <input type="hidden" name="uid" value="<?php echo $this->uid; ?>"/>
<?php
if ($this->isLoggedIn) :
?>
  <input type="submit" value="Continue..." />
<?php
else :
?>
 <input type="submit" value="Hay dang ki truoc khi thanh toan" disabled />
<?php
endif;
?>
</form></fieldset>
			</div>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>