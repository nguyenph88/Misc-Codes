<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thêm thẻ</h3>
			<p id="content">
<form name="addCard" action="main.php?act=add" method="post">
<table width="650" cellpadding="1" cellspacing="1">
	<tr>
		<td width="150">Loại thẻ</td>
		<td width="500">
		<select name="cardType" id="cardType">
<?php
foreach($this->cardType as $key => $value) :
?>
			<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php
endforeach;
?>
		</select>
		</td>
	</tr>
	<tr valign="top">
		<td width="150">Mệnh giá</td>
		<td width="500">
	<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
	</div>
	<span id="subCard"></span>
		</td>
	</tr>
	<tr valign="top">
		<td width="150">Số serial & pin, cách nhau bởi dấu , Mỗi thẻ một dòng</td>
		<td width="500"><textarea name="cards" style="width: 500px; height: 300px;"></textarea></td>
	</tr>
	<tr valign="top">
		<td width="150"></td>
		<td width="500"><input type="submit" value="Thêm thẻ" /> <input type="reset" value="Làm lại" /></td>
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