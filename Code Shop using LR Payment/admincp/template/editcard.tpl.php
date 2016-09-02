<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Quản lý mệnh giá</h3>
			<p id="content">
<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<th>Loại</th>
		<th>LR</th>
		<th>Hiện có</th>
	<tr>
<?php
foreach($this->data as $data) :
?>
	<tr>
		<td><a href="main.php?act=edit&id=<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a></td>
		<td><?php echo $data['lr']; ?> LR</td>
		<td><?php echo $data['total']; ?></td>
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
