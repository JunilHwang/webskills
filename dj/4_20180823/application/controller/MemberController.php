<?php
	class MemberController extends Controller{
		/**
		 * login page
		 */
		function login(){
			access(!$this->param->isMember,"비회원만 접근가능합니다.");
		}
		
		/**
		 * Join page
		 */
		function join(){
			access(!$this->param->isMember,"비회원만 접근가능합니다.");
		}

		/**
		 * Logout
		 */
		function logout(){
			session_destroy();
			alert("로그아웃 되었습니다.");
			move(HOME."/main");
		}

		/**
		 * Myinfomodify page
		 */
		function myinfomodify(){
			access($this->param->isMember,"회원만 접근가능합니다.");
		}
	}