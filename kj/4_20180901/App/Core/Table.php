<?php
namespace App\Core;
class Table {
	static private $instance;
	function __construct () {
		$this->board = "board";
		$this->board_set = "board_set";
		$this->member = "member";
	}

	static public function init () {
		self::$instance = new Table();
	}

	static public function getInstance () {
		return self::$instance;
	}
}