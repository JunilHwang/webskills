<?php
namespace App\Core;

class Model {

	static public $execArr = [];

	static private function init () {
		$db = new \PDO("mysql:host=127.0.0.1;dbname=4_kj_20180923;charset=utf8", "root", "");
		$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
		return $db;
	}

	static public function query ($sql) {
		$db = self::init();
		$res = $db->prepare($sql);
		if ($res->execute(self::$execArr)) {
			return $res;
		} else {
			print_pre($sql);
			print_pre(self::$execArr);
			print_pre($db->errorInfo());
			exit;
		}
	}

	static public function fetch ($sql) {
		return self::query($sql)->fetch();
	}

	static public function fetchAll ($sql) {
		return self::query($sql)->fetchAll();
	}

	static public function rowCount ($sql) {
		return self::query($sql)->rowCount();
	}

	static public function getColumn ($arr, $cancel) {
		$cancel = explode('/', $cancel);
		$column = "";
		foreach ($arr as $key=>$val) {
			if (in_array($key, $cancel)) continue;
			$column .= "{$key} = :{$key}";
			self::$execArr[":{$key}"] = $val;
		}
	}

	static public function query_set ($action, $table, $column) {
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
		$sql .= $column;
		return self::query($sql);
	}
}