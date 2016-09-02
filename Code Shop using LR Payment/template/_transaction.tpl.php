<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thẻ đã mua</h3>
			<p id="content">
<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<th>Số serial</th>
		<th>Số PIN</th>
		<th>Ngày bán</th>
	<tr>
<?php
foreach($this->items as $data) :
?>
	<tr>
		<td><?php echo $data['serial']; ?></td>
		<td><?php echo $data['pin']; ?></td>
		<td><?php echo $data['sold_date']; ?></td>
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