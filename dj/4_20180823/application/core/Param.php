<?php
	class Param{
		var $type;
		var $include_file;
		var $isMember;
		var $member;
		static public $instance;

		function __construct(){
			$param = isset($_GET['param']) ? explode("/",$_GET['param']) : null;
			$this->type = isset($param[0]) && strlen($param[0]) ? $param[0] : "main";
			$this->action = isset($param[1]) ? $param[1] : null;
			$this->include_file = isset($this->action) ? $this->action : $this->type;
			$this->isMember = isset($_SESSION['member']);
			$this->member = $this->isMember ? $_SESSION['member'] : null;
		}

		static public function init(){
			self::$instance = new Param();
		}

		static public function getInstance(){
			return self::$instance;
		}
	}