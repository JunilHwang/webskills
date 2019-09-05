<?php
	class MemberModel extends Model{
		function action(){
			$add_sql = $msg = "";
			$table = "member";
			extract($_POST);
			switch ($action) {
				case 'join':
					access(!empty($id),"아이디가 누락되었습니다.");
					access(!empty($name),"성명이 누락되었습니다.");
					access(!empty($pw),"비밀번호가 누락되었습니다.");
					access(!empty($level),"회원구분이 누락되었습니다.");
					access(!empty($tel),"전화번호가 누락되었습니다.");
					access(!empty($location),"위치정보가 누락되었습니다.");
					access(preg_match("/[a-zA-Z]{4,12}/",$id),"아이디가 형식에 맞지 않습니다.");
					access(preg_match("/[가-힣]{2,4}/",$name),"성명이 형식에 맞지 않습니다.");
					access(preg_match("/[a-zA-Z0-9]{4,8}/",$pw),"비밀번호가 형식에 맞지 않습니다.");
					access(preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}/",$tel),"전화번호가 형식에 맞지 않습니다.");
					access(!$this->rowCount("SELECT * FROM member where id = '{$id}'"),"이미 사용중인 아이디 입니다.");
					$location = explode(",",$location);
					$_POST['x_location'] = $location[0];
					$_POST['y_location'] = $location[1];
					$action = "insert";
					$msg = "회원가입 되었습니다.";
					$url = HOME."/member/login";
					break;
				case 'myinfomodify':
					if(!empty($pw)) access(preg_match("/[a-zA-Z0-9]{4,8}/",$pw),"비밀번호가 형식에 맞지 않습니다.");	
					else $_POST['pw'] = $this->param->member->pw;
					access(preg_match("/[0-9]{4}-[0-9]{4}-[0-9]{4}/",$tel),"전화번호가 형식에 맞지 않습니다.");
					$location = explode(",",$location);
					$_POST['x_location'] = $location[0];
					$_POST['y_location'] = $location[1];
					$action = "update";
					$add_sql = " where idx = '{$this->param->member->idx}'";
					$msg = "변경 되었습니다.";
					$url = HOME."/main";
					break;
				case 'login':
					access(!empty($id),"아이디가 누락되었습니다.");
					access(!empty($pw),"비밀번호가 누락되었습니다.");
					access($member = $this->fetch("SELECT * FROM member where id = '{$id}' and pw = '{$pw}'"),"아이디 또는 비밀번호가 잘못되었습니다.");
					$_SESSION['member'] = $member;
					alert("로그인 되었습니다.");
					move(HOME."/main");
					break;
			}
			$cancel = "action/location/";
			$column = $this->getColumn($_POST,$cancel).$add_sql;
			$this->querySet($action,$table,$column);
			if($this->param->include_file == 'myinfomodify') $_SESSION['member'] = $this->fetch("SELECT * FROM member where idx = '{$this->param->member->idx}'");
			alert($msg);
			move($url);
		}
	}