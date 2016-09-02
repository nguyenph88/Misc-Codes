<?php
/**
 * KCJ-pop @ manga-vn.com 2:30 PM 1/29/2009
 */
if (!defined('IN_CODE')) die("Hacking attempt");

class Users {
	/**
	 * Check if a user is logged in
	 */
	function checkLogin() {
		if (empty($_SESSION['uid']) || empty($_SESSION['username']) || empty($_SESSION['password']))
			return false;
		$query = "SELECT id FROM crd_users WHERE username = '{$_SESSION['username']}' AND password = '{$_SESSION['password']}'";
		MySQL::query($query);
		if (MySQL::rows() != 0) {
			$d = MySQL::fetch();
			if ($d['id'] != $_SESSION['uid'])
				return false;
			return true;
		}
	}
}
?>