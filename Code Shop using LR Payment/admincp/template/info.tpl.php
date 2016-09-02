<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
		<!-- VinaGame content -->
        <div class="box">
			<h3>Thông tin giao dịch</h3>
			<p id="content">
			Chọn thời gian muốn xem
		<input type="button" id="btnToday" value="Hôm nay" />
		<input type="button" id="btnYesterday" value="Hôm qua" />
		<input type="button" id="btnMonth" value="Tháng này" /><br />
			Chọn thời gian cụ thể, nếu xem tháng thì bỏ trống ngày, xem năm thì bỏ trống ngày tháng.<br />
Ngày 
<select id="lstDay">
	<option value="" selected>Chọn ngày</option>
	<option value="01">1</option>	<option value="02">2</option>
	<option value="03">3</option>	<option value="04">4</option>
	<option value="05">5</option>	<option value="06">6</option>
	<option value="07">7</option>	<option value="08">8</option>
	<option value="09">9</option>	<option value="10">10</option>
	<option value="11">11</option>	<option value="12">12</option>
	<option value="13">13</option>	<option value="14">14</option>
	<option value="15">15</option>	<option value="16">16</option>
	<option value="17">17</option>	<option value="18">18</option>
	<option value="19">19</option>	<option value="20">20</option>
	<option value="21">21</option>	<option value="22">22</option>
	<option value="23">23</option>	<option value="24">24</option>
	<option value="25">25</option>	<option value="26">26</option>
	<option value="27">27</option>	<option value="28">28</option>
	<option value="29">29</option>	<option value="30">30</option>
	<option value="31">31</option>
</select>
tháng 
<select id="lstMonth">
	<option value="" selected>Chọn tháng</option>
	<option value="01">1</option>	<option value="02">2</option>
	<option value="03">3</option>	<option value="04">4</option>
	<option value="05">5</option>	<option value="06">6</option>
	<option value="07">7</option>	<option value="08">8</option>
	<option value="09">9</option>	<option value="10">10</option>
	<option value="11">11</option>	<option value="12">12</option>
</select>
năm 
<select id="lstYear">
	<option value="2009">2009</option>
	<option value="2010">2010</option>
</select>
		<input type="button" id="btnProcess" value="Xem" /><br />
		<br /><strong>Thông tin giao dịch</strong><br />
<center>
<div id="loading" style="display: none"><img src="./images/loading.gif" width="35" height="35" />
</div>
</center>
		<span id="infoShow">
		</span>
	<script type="text/javascript">
$(document).ready(function(){
    $("#btnToday").click(function() {
		// category = $("#cardType :selected").val();
		$("#loading").show();
		$("#infoShow").load("showlog.php?mode=today", function() {
			$("#loading").hide();
		});
	});
	
	$("#btnYesterday").click(function() {
		$("#loading").show();
		$("#infoShow").load("showlog.php?mode=yesterday", function() {
			$("#loading").hide();
		});
	});
	
	$("#btnMonth").click(function() {
		$("#loading").show();
		$("#infoShow").load("showlog.php?mode=month", function() {
			$("#loading").hide();
		});
	});
	
	$("#btnProcess").click(function() {
		day = $("#lstDay :selected").val();
		month = $("#lstMonth :selected").val();
		year = $("#lstYear :selected").val();
		$("#loading").show();
		$("#infoShow").load("showlog.php?mode=date&day=" + day + "&month=" + month + "&year=" + year, function() {
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
