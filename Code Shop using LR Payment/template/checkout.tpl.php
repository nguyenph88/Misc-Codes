<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
        <div class="box">
			<h3>Checkout</h3>
<center>
	<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
	</div>
</center>
			<div id="content">
<center>When you completed order. Please click <strong>Return to merchant</strong><br />
<img src="./images/click-here.jpg" style="margin: 3px; border: 1px solid #999;" /></center>
<form action="https://sci.libertyreserve.com/" method="POST" id="frmPurchase">
  <input type="hidden" name="lr_acc" value="<?php echo $this->lr_account; ?>"/>
  <input type="hidden" name="lr_store" value="<?php echo $this->lr_store; ?>"/>
  <input type="hidden" name="lr_amnt" value="<?php echo $this->total; ?>"/>
  <input type="hidden" name="lr_currency" value="LRUSD"/>
  <input type="hidden" name="lr_comments" value="<?php echo $this->card_name; ?> x <?php echo $this->quantity; ?>"/>

  <!-- baggage fields -->
  <input type="hidden" name="quantity" value="<?php echo $this->quantity; ?>"/>
  <input type="hidden" name="card_id" value="<?php echo $this->card_id; ?>"/>
  <input type="hidden" name="time" value="<?php echo $this->time; ?>"/>
  <input type="hidden" name="username" value="<?php echo $this->username; ?>"/>
  <input type="hidden" name="email" value="<?php echo $this->email; ?>"/>
<?php
if ($this->isLoggedIn) :
?>
<center><input type="submit" value="Order now" /></center>
<?php
else :
?>
 <input type="submit" value="You're not login" disabled />
<?php
endif;
?>
</form>
			</div>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>