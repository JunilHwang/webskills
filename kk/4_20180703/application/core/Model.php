<?php
class Model {

	var $db;
	var $sql;
	var $execArr;
	var $param;
	var $lastId;
	var $close;

	function __construct () {
		$this->execArr = [];
		$this->param = Param::getInstance();
		$this->close = true;
	}

	function init () {
		$this->db = new PDO("mysql:host=127.0.0.1;dbname=kk_4_20180703;charset=utf8","root","");
		$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}

	function dbClose () {
		if ($this->close) {
			$this->db = null;
		}
		$this->close = true;
	}

	// query set
	function query ($sql = false) {
		$this->init();
		if ($sql) $this->sql = $sql;
		$res = $this->db->prepare($this->sql);
		if (!$res->execute($this->execArr)){
			echo $this->sql;
			print_pre($this->execArr, false);
			print_pre($this->db->errorInfo());
		}
		if (strpos($this->sql, "INSERT") !== false) {
			$this->lastId = $this->db->lastInsertId();
		}
		$this->dbClose();
		return $res;
	}

	// forQuery
	function forQuery () {
		$this->close = false;
		return $this->query();
	}

	// fetch one data
	function fetch ($sql = false) {
		if($sql) $this->sql = $sql;
		$data = $this->forQuery()->fetch();
		$this->dbClose();
		return $data;
	}

	// fetch all data
	function fetchAll ($sql = false) {
		if($sql) $this->sql = $sql;
		$list = $this->forQuery()->fetchAll();
		$this->dbClose();
		return $list;
	}

	// row count
	function rowCount ($sql = false) {
		if($sql) $this->sql = $sql;
		$cnt =  $this->forQuery()->rowCount();
		$this->dbClose();
		return $cnt;
	}

	// action set 
	function query_action ($action, $table, $column) {
		$sql = "";
		switch ($action) {
			case 'insert' :
				$sql .= "INSERT INTO {$table} SET ";
			break;
			case 'update' :
				$sql .= "UPDATE {$table} SET ";
			break;
			case 'delete' :
				$sql .= "DELETE FROM {$table} ";
			break;
		}
		$sql .= $column;
		$this->sql = $sql;
		return $this->query();
	}

	// get column
	function getColumn ($arr, $cancel) {
		$this->execArr = [];
		$cancel = explode("/", $cancel);
		$column = "";
		foreach ($arr as $key=>$val) {
			if (!in_array($key, $cancel)) {
				$column .= ", `{$key}` = :{$key}";
				$this->execArr[":{$key}"] = $val;
			}
		}
		$column = substr($column, 2);
		return $column;
	}
}