<?php
namespace App\Controller;
use \App;

class AdminController extends Core {
	function login () {
		access(!$this->param->isMember);
	}

	function setTemplate () {
		$this->template = "admin";
	}
}