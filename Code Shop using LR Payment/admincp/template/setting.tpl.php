<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Cấu hình</h3>
			<p id="content">
<form name="addCard" action="main.php?act=setting" method="post">
<table width="650" cellpadding="1" cellspacing="1">
	
<?php
foreach($this->data as $value) :
?>
	<tr>
		<td width="150"><?php echo $value['name']; ?></td>
		<td width="500"><input type="text" name="field[<?php echo $value['id']; ?>]" value="<?php echo $value['value']; ?>" /></td>
	</tr>
<?php
endforeach;
?>
	<tr>
		<td width="150"></td>
		<td width="500"><input type="submit" value="Cập nhật" /> <input type="reset" value="Làm lại" /></td>
	</tr>
</table>
</form>
	<script type="text/javascript">
$(document).ready(function(){
	$("#subCard").load("subcard.php?category=vinagame");
    $("#cardType").change(function() {
		type = $("#cardType :selected").val();
		$("#loading").show();
		$("#subCard").load("subcard.php?category=" + type, function() {
			$("#loading").hide();
		});
	});
	
});
	</script>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>