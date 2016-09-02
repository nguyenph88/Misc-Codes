<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , './libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
define('SITE_URL' , 'http://okaix.com/sell/');
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
require_once CLASS_DIR . 'user.class.php';
require_once LIBS_DIR  . 'Savant3.php';
$tpl  = new Savant3();
$sql  = new MySQL();
$view = new View();
$user = new Users();
$query = 'SELECT field, value FROM crd_setting WHERE id IN (6, 7)';
$sql->query($query);
if($sql->rows() != 0) {
	while($d = $sql->fetch())
		$system[$d['field']] = $d['value']; 
	if ($system['site_online'] == 0) {
		$tpl->time = $system['offline_time'] * 60;
		$tpl->title = 'Website cloes for maintain. We comeback as soon as tomorrow';
		$tpl->msg = 'Website will be comming soon. The time for maintain from  ' . $system['offline_time'] . ' minute to tomorrow.';
		$tpl->display(TPL_DIR . 'offline.tpl.php');
		exit(0);
	}
}
$isLoggedIn = $user->checkLogin();
$tpl->isLoggedIn = $isLoggedIn;
if (isset($_GET['view']))
	@require CTRL_DIR . $_GET['view'] . '.php';
else
	require CTRL_DIR . 'main.php';
?>