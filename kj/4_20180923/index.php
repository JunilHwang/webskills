<?php
	// session
	session_start();

	// path
	define('_ROOT', __dir__);
	define('_APP', _ROOT.'/App');
	define('_CORE', _APP.'/Core');
	define('_VIEW', _APP.'/view');
	define('_UPDIR', _ROOT.'/public/upload');

	// url
	define('HOME_URL', '/webskills/2018_national/kj/4_20180923');
	define('SRC_URL', HOME_URL.'/public');
	define('CSS_URL', SRC_URL.'/css');
	define('JS_URL', SRC_URL.'/js');
	define('IMG_URL', SRC_URL.'/images');
	define('UP_URL', SRC_URL.'/upload');

	// template
	include_once(_CORE.'/lib.php');

	\App\Core\Param::init();
	\App\Core\Controller::init();