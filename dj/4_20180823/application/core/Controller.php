<?php
	class Controller{
		var $param;
		var $model;

		static public function run(){
			$param = Param::getInstance();
			$type = ucfirst($param->type);
			$ctr_name = $type."Controller";
			$model_name = $type."Model";
			$ctr = new $ctr_name();
			$ctr->model = new $model_name();
			$ctr->param = $param;
			$ctr->index();
		}

		function index(){
			if(isset($_POST['action'])){
				$this->model->action();
			}
			if(method_exists($this,$this->param->include_file)){
				$this->{$this->param->include_file}();
			}

			$this->header();
			$this->content();
			$this->footer();
		}

		function header(){
			include_once(_VIEW."/template/header.php");
		}
		
		function footer(){
			include_once(_VIEW."/template/footer.php");
		}
		
		function content(){
			$thisArr = (Array)$this;
			extract($thisArr);
			include_once(_VIEW."/{$this->param->type}/{$this->param->include_file}.php");
		}

	}