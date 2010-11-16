<?php

class FDb extends mysqli {
	private $prefix;
	public function __construct($host, $user, $pass, $db, $prefix = '') {
		global $F;
		$this->prefix = $prefix;
		$db = parent::__construct($host, $user, $pass, $db);

		if (mysqli_connect_error()) {
			$F->error->fatal('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		return $db;
	}

	// Helper functions
	public function escape($str) {
		return $this->real_escape_string($str);
	}
	public function table_exists($table) {
		$result = $this->query('SHOW TABLES LIKE \''.$this->escape($table).'\'');
		return ($result->num_rows == 1) ? true : false;
	}
}
