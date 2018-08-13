<?php
	//session start
	session_start();

	// define path
	define("ROOT_PATH",dirname(__DIR__));
	define("CORE_PATH",ROOT_PATH."/core");
	define("CONFIG_PATH",ROOT_PATH."/config");
	define("DATA_PATH",ROOT_PATH."/data");
	define("VIEW_PATH",ROOT_PATH."/view");

	// define url
	define("HOME_URL","/webskils4");
	define("CSS_URL",HOME_URL."/css");
	define("JS_URL",HOME_URL."/js");
	define("IMG_URL",HOME_URL."/img");

	// parameter set
	$param = null;
	if(isset($_GET['param'])) $param = explode("/",$_GET['param']);
	$type = isset($param[0]) && $param[0] != '' ? $param[0] : 'login';
	$action = isset($param[1]) ? $param[1] : NULL;
	$idx = isset($param[2]) ? $param[2] : NULL;
	$path = isset($_GET['path']) ? $_GET['path'] : 0;
	$include_file = isset($action) ? $action : $type;
	$is_member = isset($_SESSION['member']);
	$member = $is_member ? $_SESSION['member'] : NULL;