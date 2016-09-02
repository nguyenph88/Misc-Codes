<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
	function decode($s)
	{
		$decode = pack("H*",$s);
		$decode = convert_uudecode($decode);
		return $decode;
	}

?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thẻ đã mua</h3>
			<p id="content">
<table width="95%" cellpadding="2" cellspacing="2" border="0" id="tblTransaction">
	<tr>
		<th width="30%">Loại thẻ</th>
		<th width="30%">Số serial</th>
		<th width="30%">Số PIN</th>
		<th width="10%">Ngày bán</th>
	<tr>
<?php
foreach($this->items as $data) :
?>
	<tr>
		<td width="30%"><?php echo $data['name']; ?></td>
		<td width="30%"><?php echo decode($data['serial']); ?></td>
		<td width="30%"><?php echo decode($data['pin']); ?></td>
		<td width="10%"><?php echo $data['sold_date']; ?></td>
	<tr>
<?php
endforeach;
?>
</table>
<script type="text/javascript">
$(document).ready(function() {
	var cssObj = {
        'font-weight' : 'bold',
        'color' : 'blue'
    }

	$("#tblTransaction td:eq(0)").css(cssObj);
	$("#tblTransaction td:eq(1)").css(cssObj);
	$("#tblTransaction td:eq(2)").css(cssObj);
	$("#tblTransaction td:eq(3)").css(cssObj);
});
</script>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>