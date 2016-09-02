    <div id="sidebar">
        <!-- Login box -->
		<div class="box">
<?php
if($this->isLoggedIn) :
?>
			<h3>Hello, Buyer</h3>
			<ul>
				<li><a href="./index.php?view=transaction">Detail Orders</a></li>
				<li><a href="./index.php?view=logout">Logout</a></li>
			</ul>
<?php
else :
?>
			<h3>Customer Login</h3>
			<p>
<form name="loginBox" id="loginBox" action="./index.php?view=login" method="post" style="padding: 5px;">
Username<br />
<input type="text" name="txtUserName" id="txtLogUserName" size="20" /><br />
Password<br />
<input type="password" name="txtPassword" id="txtLogPassword" size="20" /><br />
Security code<br />
<input type="text" name="txtCaptcha" id="txtLogCaptcha" size="12" />
<img src="captcha.php?mode=login" width="70" height="20" alt="captcha" /><br />
<input type="submit" value="Login" /> <input type="reset" value="Try again" /><br />

<a href="./index.php?view=fpw" alt="Click here">Forgot Password</a> - <a href="./index.php?view=register" alt="Signup new Account">Sign up</a>
</form>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#loginBox").submit(function() {
		username = $("#txtLogUserName").val();
		pw = $("#txtLogPassword").val();
		captcha = $("#txtLogCaptcha").val();
		if(username == "" || pw == "" || captcha == "") {
			alert("Please correct this sign up form. Thank you");
			return false;
		}
		
		if(captcha.length != 6) {
			alert("Password include Six Characters");
			return false;
		}
	});
});
</script>
			</p>
<?php
endif;
?>
		</div>
	<!-- Game cards -->
		<div class="box">
			<h3>THẺ ĐIỆN THOẠI</h3>
			<ul class="cardList">
				<li><a href="#" title="viettel">Viettel Mobile</a></li>
				<li><a href="#" title="vina">Vina Phone</a></li>
				<li><a href="#" title="mobi">Mobi Fone</a></li>
				<li><a href="#" title="vnmobi">Vietnamobile</a></li>
				<li><a href="#" title="sfone">S-Fone Telecom</a></li>
				<li><a href="#" title="evn">EVN Telecom</a></li>
				<li><a href="#" title="bee">Beeline</a></li>

		</ul>
		</div>
        <!-- Phone cards -->

	<!-- game card -->
		<div class="box">
			<h3>THẺ GAMES ONLINE</h3>
			<ul class="cardList">
				<li><a href="#" title="zing">Zing Card ( Vina Game )</a></li>
				<li><a href="#" title="vtc">VCoin ( VTC Online )</a></li>

			</ul>
		</div>
	<!-- game card -->	
	
	<!-- key - acc -->
		<div class="box">
			<h3>Key - Acc Host</h3>
			<ul class="cardList">
				<li><a href="#" title="win">WinDown</a></li>
				<li><a href="#" title="mega">MegaUpload</a></li>
				<li><a href="#" title="fileserve">Fileserve</a></li>
				<li><a href="#" title="hotfile">HotFile</a></li>
				<li><a href="#" title="filesonic">Filesonic</a></li>
				<li><a href="#" title="kis">Kaspersky Internet Security</a></li>
				

			</ul>
		</div>
	</div>