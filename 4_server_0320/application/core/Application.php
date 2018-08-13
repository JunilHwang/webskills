<?php
	class Application {
		static function run(){
			if(isset($_GET['q'])){
				DownController::outShare();
				return;
			}
			$param = explode("/",$_GET['param']);
			$type = isset($param[0]) && $param[0] != '' ? $param[0] : 'login';
			$type = ucfirst($type);
			$controller_name = $type."Controller";
			$controller = new $controller_name();
		}
	}