<?php
namespace App\Core;
class Param {

	static private $instance;

	function __construct () {
		if (isset($_GET['param'])) {
			$param = explode('/', $_GET['param']);
		}
		$this->page = isset($param[0]) ? $param[0] : 'main';
		$this->action = isset($param[1]) ? $param[1] : NULL;
		$this->idx = isset($param[2]) ? $param[2] : NULL;
		$this->page_num = isset($param[2]) ? $param[2] : 1;
		$this->get_page = HOME_URL."/{$this->page}";
		$this->include_file = isset($this->action) ? $this->action : $this->page;
		$this->isMember = isset($_SESSION['member']);
		$this->member = $this->isMember ? $_SESSION['member'] : NULL;
	}

	static public function init () {
		self::$instance = new Param();
	}

	static public function getInstance () {
		return self::$instance;
	}
}