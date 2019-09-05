<?php
namespace App\Core;

class Param {
	static private $instance;

	private function __construct () {
		$param = isset($_GET['param']) ? explode('/', $_GET['param']) : NULL;
		$this->page = isset($param[0]) ? $param[0] : 'page';
		$this->action = isset($param[1]) ? $param[1] : NULL;
		$this->idx = isset($param[2]) ? $param[2] : NULL;
		$this->page_num = isset($param[2]) ? $param[2] : 1;
		$this->include_file = isset($this->action) ? $this->action : $this->page;
		$this->get_page = HOME_URL."/{$this->page}";
		$this->isMember = isset($_SESSION['member']);
		$this->member = $this->isMember ? $_SESSION['member'] : NULL;
		$this->menu_toggle = isset($_SESSION['menu_toggle']);
	}

	static public function init () {
		self::$instance = new Param();
	}

	static public function getInstance () {
		return self::$instance;
	}
}