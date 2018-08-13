<?php
class MemberController extends Controller {

	function login () {
		$this->setAjax();
	}

	function register () {
		$this->setAjax();
	}

	function logout () {
		session_destroy();
		alert('로그아웃 되었습니다.');
		move(HOME_URL);
	}
}