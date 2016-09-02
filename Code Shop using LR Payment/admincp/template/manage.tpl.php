<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Quản lý thẻ</h3>
			<p id="content">
			Chọn loại thẻ muốn xem	
		<select name="category" id="cardType">
<?php
foreach($this->cardType as $key => $value) :
?>
			<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php
endforeach;
?>
		</select>
		Tình trạng
		<select name="status" id="cardStatus">
			<option value="0">Chưa bán</option>
			<option value="1">Đã bán</option>
		</select>
		<input type="button" id="btnShow" value="Xem" />
<center>
<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
</div>
</center>
		<span id="cardShow">
		</span>
	<script type="text/javascript">
$(document).ready(function(){
	function loadCard (category, status, offset) {
		$("#loading").show();
		$("#cardShow").load("showcard.php?category=" + category + "&status=" + status + "&offset=" + offset, function() {
			$("#loading").hide();
		});
	};

    $("#btnShow").click(function() {
		category = $("#cardType :selected").val();
		status = $("#cardStatus :selected").val();
		loadCard(category, status, 0);
	});
	
});
	</script>
			</p>
		</div>
    </div>
<?php
	include TPL_DIR . 'footer.tpl.php';
?>
