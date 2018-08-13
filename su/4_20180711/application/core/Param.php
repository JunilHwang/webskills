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
			$this->page_num = isset($param[2]) ? $param[2] : 1;
			$this->search_key = isset($param[3]) && $param[3] != '' ? urldecode($param[3]) : NULL;
			$this->tag = isset($_GET['tag']) && $_GET['tag'] != '' ? urldecode($_GET['tag']) : NULL;
			$this->include_file = isset($this->action) ? $this->action : $this->type;
			$this->isMember = isset($_SESSION['member']);
			$this->isSub = $this->type != 'main';
			$this->member = $this->isMember ? $_SESSION['member'] : NULL;
			$this->get_page = HOME_URL."/{$this->type}";
			$this->site_title = "여수시 관광정보";
		}

		public static function getInstance () {
			return self::$instance;
		}

		public static function init () {
			self::$instance = new Param();
		}
	}