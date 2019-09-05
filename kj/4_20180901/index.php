<?php
	//session
	session_start();

	// define
	define('_ROOT', __DIR__);
	define('_APP', _ROOT.'/App');
	define('_CORE', _APP.'/Core');
	define('_CONTROLLER', _APP.'/Controller');
	define('_MODEL', _APP.'/Model');
	define('_VIEW', _APP.'/view');
	define('_CONFIG', _APP.'/config');

	// URL
	define('HOME_URL', '/webskills/2018_national/kj/4_20180901');
	define('SRC_URL', HOME_URL.'/public');
	define('CSS_URL', SRC_URL.'/css');
	define('JS_URL', SRC_URL.'/js');
	define('IMG_URL', SRC_URL.'/images');

	// autoload
	include_once(_CONFIG.'/lib.php');

	App\Core\Param::init();
	App\Core\Table::init();
	App\Controller\Core::init();
	