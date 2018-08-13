<?php
	// define path
	define("ROOT_PATH",__DIR__);
	define("APP_PATH",ROOT_PATH."/application");
	define("PUBLIC_PATH",ROOT_PATH."/public");
	define("CORE_PATH",APP_PATH."/core");
	define("CONFIG_PATH",APP_PATH."/config");
	define("DATA_PATH",APP_PATH."/data");
	define("CONTROLLER_PATH",APP_PATH."/controller");
	define("MODEL_PATH",APP_PATH."/model");
	define("VIEW_PATH",APP_PATH."/view");
	define("PAGE_PATH",VIEW_PATH."/page");

	// define url
	define("HOME_URL","/0320");
	define("CSS_URL",HOME_URL."/css");
	define("JS_URL",HOME_URL."/js");
	define("IMG_URL",HOME_URL."/img");

	// app run
	include_once(CONFIG_PATH."/config.php");
	include_once(CONFIG_PATH."/lib.php");
	Application::run();