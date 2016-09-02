<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<base href="<?php echo SITE_URL; ?>" />
<head profile="http://gmpg.org/xfn/11">
    <title>Siêu Tốc - Siêu Rẻ, Siêu Lag, Siêu Delay</title>
    <link rel="stylesheet" type="text/css" href="./images/main.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="../js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	this.loadCard = function (category, status, offset) {
		$("#loading").show();
		$("#cardShow").load("showcard.php?category=" + category + "&status=" + status + "&offset=" + offset, function() {
			$("#loading").hide();
		});
	};	
});
	</script>
</head>
<body>
<center>
<div class="wrapper">
    <div id="header"><h1><a href="main.php">Trang quản lý</a></h1></div>
	<div class="clear"></div>