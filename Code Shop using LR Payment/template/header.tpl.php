<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<base href="<?php echo SITE_URL; ?>" />
<head profile="http://gmpg.org/xfn/11">
<title>VNZ - Cung Cap Card Game Gia Re</title>
<link rel="stylesheet" type="text/css" href="./images/main.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<script src="./js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="./js/jquery.countdown.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".cardList > li > a").click(function() {
	 $("#welcome").hide();
	 $("#loading").show();
	 $("#content").load("loadcard.php?card=" + this.title, function() {
	 $("#loading").hide();
	 });
	 return false;
	});
});
	</script>
</head>
<body>
    <div id="logo">
    <a href="index.php"><center><img src="banner.jpg" width="960" height="180" alt="Licence Keys Stores" border="0"><center></a>
    </div>
<center>
<div class="wrapper">
<div id="header"><h1>Welcome to WwW.VNZid.Net</h1></div>
<div class="clear"></div>