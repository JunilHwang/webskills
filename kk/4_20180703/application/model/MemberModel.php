<?php
Class MemberModel extends Model {
	function action () {
		$sql = $add_sql = $column = $msg = $url = $cancel = "";
		extract($_POST);
		$table = 'member';
		switch ($action) {
			case 'insert' :
				$len = strlen($name)+strlen($email)+strlen($password)+strlen($email);
				access($len, "누락된 항목이 있습니다.");
				access($password == $confirm, "비밀번호 확인을 정확히 입력해주세요");
				$this->execArr = [$email, $name];
				access($this->rowCount("SELECT * FROM member where email=? or name=?") == 0, "이름 혹은 이메일이 중복되었습니다");
				$msg = "회원가입이 완료되었습니다.";
				$url = false;
			break;
			case 'login' :
				$this->sql = "SELECT * FROM member where name = ? and password = ?";
				$this->execArr = [$name, $password];
				$res = $this->query();
				access($res->rowCount() == 1, "아이디 혹은 비밀번호가 일치하지 않습니다");
				$_SESSION['member'] = $res->fetch();
				alert('로그인 되었습니다.');
				move(URL);
				exit;
			break;
		}
		$cancel .= "idx/confirm/action/";
		$column = $this->getColumn($_POST, $cancel);
		if($this->query_action($action, $table, $column.$add_sql)){
			alert($msg);
			move($url);
		} else {
			echo $sql;
		}
		exit;
	}
}