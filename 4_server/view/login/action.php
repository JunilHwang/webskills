<?php
	extract($_POST);
	$add_sql = "";
	switch($action){
		case 'login' :
			$salt = "webskills";
			$pw = hash("sha256",$pw.$id);
			$sql = "SELECT * FROM member where id='{$id}' and pw='{$pw}'";
			access($member = fetch($sql),"아이디 또는 비밀번호가 일치하지 않습니다.");
			$_SESSION['member'] = $member;
			alert("로그인 되었습니다.");
			move(HOME_URL."/file");
		break;
	}