<?php
if (!defined('IN_CODE')) die("Hacking attempt");
include 'cfg.php';
$tpl->cardType = $cardType;
$tpl->display(TPL_DIR . 'manage.tpl.php');
?>