<?php
define('CTRL_DIR' , './controllers/' );
define('CLASS_DIR', './classes/'     );
define('LIBS_DIR' , '../libs/'        );
define('TPL_DIR'  , './template/'    );
define('IN_CODE'  , TRUE             );
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
require_once CLASS_DIR . 'mysql.class.php';
require_once CLASS_DIR . 'view.class.php';
$sql  = new MySQL();
$output = '';
$query = "SELECT id, name FROM crd_card WHERE category = '{$_GET['category']}' ORDER BY vnd";
$sql->query($query);
if ($sql->rows() != 0) {
	$output .= '<select id="subCard" name="card_type_id">';
	while($d = $sql->fetch()) {
		$output .= <<< HTML
<option value="{$d['id']}">{$d['name']}</option>
HTML;
	}
	$output .= '</select>';
} else {
	$output .= 'Không có';
}
echo $output;
?>