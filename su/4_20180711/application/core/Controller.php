<?php
class Controller {

	var $model;
	var $isMember;
	var $member;
	var $list;
	var $data;
	var $param;
	var $ajax;
	var $main;

	static public function run () {
		$param = Param::getInstance();
		$type = ucfirst($param->type);
		$ctrName = $type."Controller";
		$modelName = $type."Model";
		$model = new $modelName();
		$ctr = new $ctrName($param, $model);
	}

	function __construct ($param, $model) {
		$this->model = $model;
		$this->param = $param;
		$this->ajax = false;
		$this->table = Table::getInstance();

		if (isset($_POST['action'])) {
			$model->action();
			exit;
		}
		if (method_exists($this, $param->include_file)) {
			$this->{$param->include_file}();
		}

		$thisArr = (Array)$this;
		extract($thisArr);

		$this->ajax || include_once(_VIEW."/template/header.php");
		include_once(_VIEW."/{$param->type}/{$param->include_file}.php");
		$this->ajax || include_once(_VIEW."/template/footer.php");
	}

	function setAjax () {
		$this->ajax = true;
	}
}