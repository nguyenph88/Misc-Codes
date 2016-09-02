<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thông tin giao dịch</h3>
			<p id="content">
<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<th>Người mua</th>
		<th>Loại thẻ</th>
		<th>Tổng tiền</th>
		<th>Thời gian</th>
	<tr>
<?php
foreach($this->data as $data) :
?>
	<tr>
		<td><?php echo $data['username']; ?></td>
		<td><?php echo $data['buy_what']; ?></td>
		<td><?php echo $data['total']; ?></td>
		<td><?php echo $data['when']; ?></td>
	<tr>
<?php
endforeach;
?>
</table>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>
