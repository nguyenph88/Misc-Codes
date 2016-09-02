<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Sửa thẻ</h3>
			<p id="content">
<form name="editCard" action="main.php?act=edit&amp;id=<?php echo $this->id; ?>" method="post">
<table width="650" cellpadding="1" cellspacing="1">
	<tr valign="top">
		<td width="250">Tên thẻ</td>
		<td width="400"><input type="text" name="name" style="width: 100%;" value="<?php echo $this->name; ?>" /></td>
	</tr>
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
		<td width="250">Giá VND: VD: 60000</td>
		<td width="400"><input type="text" name="vnd" style="width: 100%;" value="<?php echo $this->vnd; ?>" /></td>
	</tr>
	<tr valign="top">
		<td width="250">Giá LR x 100: VD: 4 LR = 400</td>
		<td width="400"><input type="text" name="lr" style="width: 100%;" value="<?php echo $this->lr; ?>" /></td>
	</tr>
	<tr valign="top">
		<td width="250">Hình</td>
		<td width="400"><input type="text" name="image" style="width: 100%;" value="<?php echo $this->image; ?>" /></td>
	</tr>

	<tr valign="top">
		<td width="150"></td>
		<td width="500"><input type="submit" value="Sửa thẻ" /> <input type="reset" value="Làm lại" /></td>
	</tr>
</table>
</form>
	<script type="text/javascript">
$(document).ready(function(){
	$("#cardType").each(function() {
		val = this.val();
		if (val == "<?php echo $this->category; ?>") {
			this.selected = true;
			return;
		}
	});
	
});
	</script>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>