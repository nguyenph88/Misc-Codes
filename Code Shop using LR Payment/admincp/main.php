<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , '../libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
define('SITE_URL' , 'http://okaix.com/sell/admincp/');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
define('ADM_EMAIL', 'admin@');
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
require_once LIBS_DIR  . 'Savant3.php';
$tpl  = new Savant3();
$sql  = new MySQL();
$view = new View();
if (isset($_GET['act']))
	@require CTRL_DIR . $_GET['act'] . '.php';
else
	require CTRL_DIR . 'main.php';
?>