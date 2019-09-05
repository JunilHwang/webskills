<?php
	class Model{
		var $param;
		var $db;
		var $sql;
		var $execArr;
		var $close;
		var $lastId;

		function __construct(){
			$this->param = Param::getInstance();
			$this->execArr = [];
			$this->close = true;
		}

		function init(){
			$this->db = new PDO("mysql:host=127.0.0.1;charset=utf8;dbname=delivery","root","");
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		}

		function dbClose(){
			if($this->close) $this->db = null;
			$this->close = true;
		}

		/**
		 * query set
		 * @param  string $sql query sentence
		 * @return             query sequence
		 */
		function query($sql = false){
			$this->init();
			if($sql) $this->sql = $sql;
			$res = $this->db->prepare($this->sql);
			if(!$res->execute($this->execArr)){
				echo $this->sql;
				print_pre($this->execArr,false);
				print_pre($this->db->errorInfo());
			}
			if(strpos($this->sql,"INSERT") !== false){
				$this->lastId = $this->db->lastInsertId();
			}
			$this->dbClose();
			return $res;
		}

		function forQuery(){
			$this->close = false;
			return $this->query();
		}

		/**
		 * fetch one data
		 * @param  string $sql query sentence
		 * @return object      one data
		 */
		function fetch($sql = false){
			if($sql) $this->sql = $sql;
			$data = $this->forQuery()->fetch();
			$this->dbClose();
			return $data;
		}

		/**
		 * fetch all data
		 * @param  string $sql query sentence
		 * @return object      all data list
		 */
		function fetchAll($sql = false){
			if($sql) $this->sql = $sql;
			$list = $this->forQuery()->fetchAll();
			$this->dbClose();
			return $list;
		}

		/**
		 * count data
		 * @param  string $sql query sentence
		 * @return object      the number of data
		 */
		function rowCount($sql = false){
			if($sql) $this->sql = $sql;
			$cnt = $this->forQuery()->rowCount();
			$this->dbClose();
			return $cnt;
		}

		/**
		 * get column
		 * @param  array $arr    column을 얻을 배열
		 * @param  string $cancel 삭제할 요소
		 * @return string         column
		 */
		function getColumn($arr,$cancel){
			$this->execArr = [];
			$column = "";
			$cancel = explode("/",$cancel);
			foreach ($arr as $key => $val) {
				if(in_array($key,$cancel)) continue;
				$column .= ", {$key} = :{$key}";
				$this->execArr[":{$key}"] = $val;
			}
			$column = substr($column,2);
			return $column;
		}

		function querySet($action,$table,$column){
			switch ($action) {
				case 'insert':
					$sql = "INSERT INTO {$table} SET ";
					break;
				case 'update':
					$sql = "UPDATE {$table} SET ";
					break;
				case 'delete':
					$sql = "DELETE FROM {$table} ";
					break;
			}
			$this->sql = $sql.$column;
			return $this->query();
		}

	}