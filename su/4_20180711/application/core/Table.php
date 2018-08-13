<?php
class Table {

	static private $instance;

	function __construct () {
		$prefix = "su_";
		$this->board = $prefix.'board';
		$this->comment = $prefix.'comment';
		$this->member = $prefix.'member';
		$this->file = $prefix.'file';
		$this->course = $prefix.'course';
		$this->cost = $prefix.'time_cost';
		$this->tour = $prefix.'tourist_destination';
		$this->tag = $prefix.'tourist_tag';
		$this->searched = $prefix.'searched';
	}

	// initialize
	function init () {
		Table::setInstance();
	}

	static private function setInstance () {
		Table::$instance = new Table();
	}

	static public function getInstance () {
		return Table::$instance;
	}
}