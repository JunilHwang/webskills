<?php
	class Model {
		protected $db;
		protected $sql;
		protected $cr; // Controller

		function __construct($cr){
			$this->db = new PDO("mysql:host=127.0.0.1;dbname=0320;charset=utf8","root","nif");
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
			$this->cr = $cr;
		}

		function query($sql = false){
			if($sql) $this->sql = $sql;
			if($res = $this->db->query($this->sql)){
				return $res;
			} else {
				echo $this->sql;
				echo "<pre>";
				print_r($this->db->errorInfo());
				echo "</pre>";
				exit;
			}
		}

		function fetch($sql = false){
			if($sql) $this->sql = $sql;
			return $this->query()->fetch();
		}

		function rowCount($sql = false){
			if($sql) $this->sql = $sql;
			return $this->query()->rowCount();
		}

		function fetchAll($sql = false){
			if($sql) $this->sql = $sql;
			return $this->query()->fetchAll();
		}

		function getParam(){
			return $this->cr->param;
		}

		function getMemberInfo(){
			return $this->cr->member;
		}

		function action(){}
	}