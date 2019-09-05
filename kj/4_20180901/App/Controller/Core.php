<?php
namespace App\Controller;

class Core {
	static public function init () {
		$param = \App\Core\Param::getInstance();
		$prefix = ucfirst($param->page);
		$controllerName = "\\App\\Controller\\".$prefix.'Controller';
		$modelName = "\\App\\Model\\".$prefix.'Model';
		new $controllerName($modelName, $param);
	}

	function __construct ($modelName, $param) {
		$this->param = $param;
		$this->model = new $modelName();
		if(isset($_POST['action'])) {
			$this->model->action();
			exit;
		}
		if (method_exists($this, $param->include_file)) {
			$this->{$param->include_file}();
		}
		extract((Array)$this);
		$this->template = "template";
		if(method_exists($this, "setTemplate")) $this->setTemplate();
		include_once(_VIEW."/{$this->template}/header.php");
		include_once(_VIEW."/{$param->page}/{$param->include_file}.php");
		include_once(_VIEW."/{$this->template}/footer.php");
	}
}