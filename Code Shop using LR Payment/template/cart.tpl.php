<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
		<div class="box">
			<h3>Your items</h3>
			<?php echo $this->c; ?><br />
			<input type="button" onclick="emptyCart();" value="Clear" />
			<input type="button" onclick="checkOut();" value="Thanh Toan" />
		</div>
        <div class="box">
			<h3>Items</h3>
			<p id="content">
<center>
	<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
	</div>
</center>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>