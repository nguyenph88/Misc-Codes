<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thêm mệnh giá</h3>
			<p id="content">
<form name="addCard" action="main.php?act=subcard" method="post">
<table width="650" cellpadding="1" cellspacing="1">
	<tr valign="top">
		<td width="250">Tên. VD: Thẻ VinaGame 60.000</td>
		<td width="400"><input type="text" name="cardName" style="width: 100%;" /></td>
	</tr>
	<tr>
		<td width="250">Loại thẻ</td>
		<td width="400">
		<select name="category" id="cardType">
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
		<td width="250">Giá VND: VD: 60000</td>
		<td width="400"><input type="text" name="vnd" style="width: 100%;" /></td>
	</tr>
	<tr valign="top">
		<td width="250">Giá LR x 100: VD: 4 LR = 400</td>
		<td width="400"><input type="text" name="lr" style="width: 100%;" /></td>
	</tr>
	<tr valign="top">
		<td width="250">Hình</td>
		<td width="400"><input type="text" name="image" style="width: 100%;" value="./cards/" /></td>
	</tr>

	<tr valign="top">
		<td width="150"></td>
		<td width="500"><input type="submit" value="Thêm thẻ" /> <input type="reset" value="Làm lại" /></td>
	</tr>
</table>
</form>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>