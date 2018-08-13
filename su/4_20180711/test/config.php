<?php
	//path
	define('_ROOT', dirname(__DIR__));
	define('_APP', _ROOT."/application");
	define('_CORE', _APP."/core");
	define('_MODEL', _APP."/model");
	define('_CONTROLLER', _APP."/controller");
	define('_VIEW', _APP."/view");
	define('_CONFIG', _APP."/config");
	define('_PUBLIC', _ROOT."/public");
	define('_UPDIR', _PUBLIC."/upload");

	//url
	define('HOME_URL', str_replace("/index.php","",$_SERVER['PHP_SELF']));
	define('SRC_URL', HOME_URL.'/public');
	define('IMG_URL', SRC_URL.'/img');
	define('CSS_URL', SRC_URL.'/css');
	define('JS_URL', SRC_URL.'/js');
	define('UP_URL', SRC_URL.'/upload');
	
	// session
	session_start();

	// include
	include_once(_CONFIG."/lib.php");
	Table::init();