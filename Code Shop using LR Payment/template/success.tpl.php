<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thông tin thẻ</h3>
			<p id="content">
<?php
if($this->check) :
?>
<style type="text/css">
#cardResult tr td{
	font-size: 1.5em;
	border: 1px solid #666;
	width: 30%;
}
</style>
	<table width="100%" cellpadding="2" cellspacing="2" border="0" id="cardResult">
<?php
$n = 0;
foreach($this->items as $data) :
?>
		<tr>
			<td>
			Số pin: <?php echo $data['pin']; ?><br />
			Số serial: <?php echo $data['serial']; ?>
			</td>
		</tr>
<?php
endforeach;
?>
	</table>
<?php
else :
?>
	Xin lỗi nhưng hiện chúng tôi chỉ còn <strong><?php echo $this->numberOfCard; ?></strong> thẻ. Có thể ai đó vừa mới mua trước bạn. Xin vui lòng thử lại.
<?php
endif;
?>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>