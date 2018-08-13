<?php
	class Param {
		var $type;
		var $action;
		var $idx;
		var $include_file;
		var $isMember;
		var $member;
		static public $instance;
		function __construct() {
			if (isset($_GET['param'])) {
				$param = explode("/", $_GET['param']);
			}
			$this->type = isset($param[0]) && strlen($param[0]) ? $param[0] : 'main';
			$this->action = isset($param[1]) ? $param[1] : NULL;
			$this->idx = isset($param[2]) ? $param[2] : NULL;
			$this->version = isset($param[3]) ? $param[3] : NULL;
			$this->file = isset($param[4]) ? $param[4] : 0;
			$this->include_file = isset($this->action) ? $this->action : $this->type;
			$this->isMember = isset($_SESSION['member']);
			$this->compareFrom = isset($_GET['from']) ? $_GET['from'] : NULL;
			$this->compareFile = isset($_GET['compare_file']) ? $_GET['compare_file'] : NULL;
			$this->member = $this->isMember ? $_SESSION['member'] : NULL;
			$this->get_page = URL."/{$this->type}";
		}

		public static function getInstance () {
			return self::$instance;
		}

		public static function init () {
			self::$instance = new Param();
		}
	}