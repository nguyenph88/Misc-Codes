<?php
if (!defined('IN_CODE')) die("Hacking attempt");
$tpl->title = 'Please tell us your email for get new password';
$tpl->msg = '<center>For security reson, this request not valid.<br>
Please contact with our <a href="/contact/?">support now</a>.
We will contact to you as soon as posible.<br> Thank you so much.</center>
';
$tpl->display(TPL_DIR . 'message.tpl.php');
?>