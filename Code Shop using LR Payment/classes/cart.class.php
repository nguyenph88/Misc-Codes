<?php
/**
 * KCJ-pop @ manga-vn.com 2:30 PM 1/29/2009
 */
if (!defined('IN_CODE')) die("Hacking attempt");

class Cart {
	/**
	 * Get items list
	 * @param string $str string to be formatted
	 */
	function processItems($string) {
		$items = array();
		$card_id = '';	
		// Get the current session value, strip the last |
		$data = substr($_SESSION['data'], 0, -1);
		// Eplode $data into an array, after exploding, each member will be in form --> x,y
		$tmp = explode('|', $data);
		// Sort it using a case insensitive "natural order" algorithm
		natcasesort($tmp);
		// Use one foreach loop to make a string used in query
		foreach($tmp as $value) {
			$item = explode(',', $value);
			$card_id .= $item[0] . ',';
		}
		// Strip the last colon, $card_id will be in form ---> x,y,z
		$card_id = substr($card_id, 0, -1);
		// Query to get the name and LR value from crd_card
		$query = 'SELECT id, name, lr FROM crd_card WHERE id IN (' . $card_id . ') ORDER BY vnd ASC';
		// echo $query;
		MySQL::query($query);
		if(MySQL::rows() != 0) {
			while($d = MySQL::fetch()) {
			// Array $items is grouped by id
				$items[$d['id']]['name'] = $d['name'];
				// Calculate value of LR
				$items[$d['id']]['lr'] = (float) $d['lr'] / 100;
				// Set quatity of this member is zero
				$items[$d['id']]['quatity'] = 0;
			}
		}
		// Re-use $tmp to get the quatity
		foreach($tmp as $value) {
			$item = explode(',', $value);
			// $item[0] is card_id & $item[1] is quatity
			$i = $item[0];
			$items[$i]['quatity'] += (int) $item[1];
			// Calculate the total
			$items[$i]['total'] = $items[$i]['quatity'] * $items[$i]['lr'];
		}
		return $items;
	}
}
?>