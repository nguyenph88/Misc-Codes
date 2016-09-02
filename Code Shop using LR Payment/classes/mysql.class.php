<?php
/**
 * KCJ-pop @ manga-vn.com 2:30 PM 1/29/2009
 */
if (!defined('IN_CODE')) die("Hacking attempt");

class MySQL {
	private $link;
	// Resutl from querying
	private $result;
	
	function __construct() {
		require_once('cfg.php');
		$this->connect($config['dbHostname'], $config['dbUsername'], $config['dbPassword'], $config['dbName']);
	}
	
	// Connect to database
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
	
	// Query from database
	function query($str) {
		$this->result = @mysql_query($str) or
			die('Unable to query from MySQL database. MySQL reported: '.mysql_error());
		return $this->result;
	}
	
	// Run query
	function runQuery($str) {
		if (@mysql_query($str))
			return TRUE;
		else {
			die('Unable to query from MySQL database. MySQL reported: '.mysql_error());
			return FALSE;
		}
	}
	
	// Shorthand for mysql_fetch_array
	function fetch() {
		return mysql_fetch_array($this->result);
	}
	
	// Shorthand for mysql_num_rows
	function rows() {
		return mysql_num_rows($this->result);
	}
}
?>