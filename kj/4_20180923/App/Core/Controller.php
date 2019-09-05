<?php
namespace App\Core;

class Controller {
	var $template = "template";
	function __construct ($param) {
		$this->param = $param;

		$method = $param->include_file;
		if (isset($_POST['action'])) {
			$this->post_action();
			exit;
		}
		if (method_exists($this, $method)) {
			$this->{$method}();
		}
		extract((Array)$this);
		if (method_exists($this, "setTemplate")) $this->setTemplate();
		if(isset($this->template)) include_once(_VIEW."/{$this->template}/header.php");
		include_once(_VIEW."/{$param->page}/{$param->include_file}.php");
		if(isset($this->template)) include_once(_VIEW."/{$this->template}/footer.php");
	}

	static public function init () {
		$param = Param::getInstance();
		$controllerName = "\\App\\Controller\\".ucfirst($param->page)."Controller";
		new $controllerName($param);
	}
}