<?php
if (!defined('IN_CODE')) die("Hacking attempt");

$tpl->title = 'Your order not complete';
$tpl->msg = 'The processing not finish. Please contact US to know what happen' . ADM_EMAIL;
$tpl->display(TPL_DIR . 'message.tpl.php');
?>