<?php
namespace App\Model;

class Core {

	public $execArr = [];

	function init () {
		$this->db = new PDO("mysql:host=127.0.0.1;dbname=20180901;charset=utf8", "root", "");
		$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	}

	function query ($sql = false) {
		if($sql) $this->sql = $sql;
		$this->init();
		$res = $this->db->prepare($this->sql);
		if (!$res->execute($this->execArr)) {
			\println($sql);
			\print_pre($this->db->errorInfo());
		}
		$this->db = null;
		return $res;
	}

	function fetch ($sql = false) {
		if($sql) $this->sql = $sql;
		return $this->query()->fetch();
	}

	function fetchAll ($sql = false) {
		if($sql) $this->sql = $sql;
		return $this->query()->fetchAll();
	}

	function rowCount ($sql = false) {
		if($sql) $this->sql = $sql;
		return $this->query()->rowCount();
	}

	function getParam ($cancel, $arr) {
		$cancel = explode('/', $cancel);
		$column = '';
		foreach ($arr as $key=>$val) {
			if(!in_array($key, $cancel)) {
				$column = ", {$key}=:{$key}";
				$this->execArr[":{$key}"] = $val;
			}
		}
		return substr($column, 2);
	}

	function query_result ($action, $table, $column) {
		switch ($action) {
			case 'insert' :
				$sql = "INSERT INTO {$table} SET ";
			break;
			case 'update' :
				$sql = "UPDATE {$table} SET ";
			break;
			case 'delete' :
				$sql = "DELETE FROM {$table} ";
			break;
		}
		return $this->query($sql.$column);
	}
}