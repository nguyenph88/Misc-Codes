<?php
if (!defined('IN_CODE')) die("Hacking attempt");
class MySQL {
	private $link;
	private $result;
	function __construct() {
		require_once('cfg.php');
		$this->connect($config['dbHostname'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
	}
	function connect($dbHost, $dbUsername, $dbPassword, $dbName) {
		$this->link = @mysql_connect($dbHost, $dbUsername, $dbPassword);
		if ($this->link) {
			if (@mysql_select_db($dbName, $this->link))
				return $this->link;
			else
				die('Unable to select database. MySQL reported: '.mysql_error());
		}
		else
			die('Unable to connect to MySQL server. MySQL reported: '.mysql_error());
	}
	function query($str) {
		$this->result = @mysql_query($str) or
			die('Unable to query from MySQL database. MySQL reported: '.mysql_error());
		return $this->result;
	}
	function runQuery($str) {
		if (@mysql_query($str))
			return TRUE;
		else {
			die('Unable to query from MySQL database. MySQL reported: '.mysql_error());
			return FALSE;
		}
	}
	function fetch() {
		return mysql_fetch_array($this->result);
	}
	function rows() {
		return mysql_num_rows($this->result);
	}
}
?>