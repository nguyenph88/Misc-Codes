<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<base href="<?php echo SITE_URL; ?>" />
<head profile="http://gmpg.org/xfn/11">
    <title>Siêu Tốc - Siêu Rẻ, Siêu Lag, Siêu Delay</title>
    <link rel="stylesheet" type="text/css" href="./images/main.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="Buy Game Cards Online, Mua Thẻ Game Online, Bán Thẻ Game Online, Thanh Toán Paypal, Mua Thẻ Võ Lâm Truyền Kỳ, Mua thẻ VLTK, Mua Thẻ VinaCard, Buy @Cash Online, Buy eCash Online, PTV Online, Cửu Long Tranh Bá, TSOnline, GunBound, Hiệp Khách Giang Hồ, Tam Quốc Chí, Con Đường Tơ Lụa,VCoin, Vcard, VTC Games, Audition Cards, Space Cowboy Cards, mua the game, muathegame" />

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
<center>
<div class="wrapper">

    <div id="header"><h1>Thẻ game Siêu Tốc - Siêu Rẻ, Siêu Lag, Siêu Delay</h1></div>
	<div class="clear"></div>