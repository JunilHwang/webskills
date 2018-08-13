<?php
	Class LoginController extends Controller {
		function login(){
			if($this->is_member){
				echo (HOME_URL."/file");
			}
		}

		function logout(){
			session_destroy();
			alert('로그아웃 되었습니다.');
			move(HOME_URL);
		}
	}