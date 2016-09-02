<?php
	include TPL_DIR . 'header.tpl.php';
	include TPL_DIR . 'sidebar.tpl.php';
?>
	<div id="main">
        <div class="box">
			<h3>Hello, Please complete sign up form below</h3>
			<p id="content">
<form action="./index.php?view=register" method="post" id="frmRegister">
<table width="95%" cellpadding="2" cellspacing="2" border="0">
	<tr>
		<td width="20%">Username</td>
		<td width="30%"><input type="text" name="txtUsername" id="txtUsername" style="width: 90%;" /></td>
		<td width="20%">Email</td>
		<td width="30%"><input type="text" name="txtEmail" id="txtEmail" style="width: 90%;" /></td>
	<tr>
	<tr>
		<td width="20%">Your Password</td>
		<td width="30%"><input type="password" name="txtPW1" id="txtPW1" style="width: 90%;" /></td>
		<td width="20%">Retype Password</td>
		<td width="30%"><input type="password" name="txtPW2" id="txtPW2" style="width: 90%;" /></td>
	<tr>
	<tr>
		<td width="20%">Security code (Correct follow images)</td>
		<td width="30%"><input type="text" name="txtCaptcha" id="txtCaptcha" style="width: 90%;" /></td>
		<td width="20%"><img src="captcha.php?mode=register" width="70" height="20" alt="captcha" /></td>
		<td width="30%"></td>
	<tr>
</table>
<center><input type="submit" value="Register now" /></center>
</form>
<script type="text/javascript">
$(document).ready(function() {
	function validateEmail(elementValue) {      
		var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		return emailPattern.test(elementValue);
	}
	$("#frmRegister").submit(function() {
		username = $("#txtUsername").val();
		email = $("#txtEmail").val();
		pw1 = $("#txtPW1").val();
		pw2 = $("#txtPW2").val();
		captcha = $("#txtCaptcha").val();
		if(username == "" || email == "" || pw1 == "" || pw2 == "" || captcha == "") {
			alert("Please correct all field on form.");
			return false;
		}
		if (!validateEmail(email)) {
			alert("Your email not valid");
			return false;
		}
		if(pw1 != pw2) {
			alert("Please correct Password");
			return false;
		}
		if(captcha.length != 6) {
			alert("Security code include six character or number");
			return false;
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