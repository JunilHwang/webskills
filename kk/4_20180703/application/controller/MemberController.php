<?php
class MemberController extends Controller {

	function logout () {
		session_destroy();
		alert('로그아웃 되었습니다.');
		move(URL);
		exit;
	}

}