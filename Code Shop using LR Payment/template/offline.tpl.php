<?php
	include TPL_DIR . 'header.tpl.php';
?>
	<div id="main" style="width: 100%;">
		<!-- VinaGame content -->
        <div class="box">
			<h3><?php echo $this->title; ?></h3>
			<div style="font-size: 2.3em; font-family: Times;">
			<?php echo $this->msg; ?><br />
				Còn <strong>
				<span id="countdown" style="color: red;">
				</span></strong>
				giây
			</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#countdown').countdown({seconds: <?php echo $this->time; ?>});
});
</script>
			</div>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>
