<?php
class MemberModel extends Model {

	function getMemberList(){
		return $this->fetchAll("SELECT * FROM member order by idx asc");
	}

	function getMember(){
		$param = $this->getParam();
		return $this->fetch("SELECT * FROM member where idx='{$param->idx}'");
	}

	function setMemberDelete(){
		$param = $this->getParam();
		$file_list = $this->fetchAll("SELECT * FROM files where midx='{$param->idx}'");
		foreach($file_list as $data){
			@unlink(DATA_PATH."/{$data->change_name}");
		}
		$sql = "
			DELETE FROM member where idx='{$param->idx}';
			DELETE FROM files where midx='{$param->idx}';
			DELETE FROM outfile_list where midx='{$param->idx}';
			DELETE FROM infile_list where midx='{$param->idx}';
		";
		$this->query();
		alert("완료되었습니다.");
		move();
	}

	function action(){
		extract($_POST);
		$param = $this->getParam();
		$msg = "완료되었습니다.";
		$url = HOME_URL."/member/list";
		switch($action){
			case 'insert' :
				access($this->rowCount("SELECT idx FROM member where id='{$id}'") == 0, "중복된 아이디가 있습니다.");
				$salt = "webskills";
				$pw = hash("sha256",$pw.$salt);
				$this->sql = "
					INSERT INTO member SET
					id='{$id}',
					pw='{$pw}',
					name='{$name}',
					level='1';
				";
			break;
			case 'update' :
				access($this->rowCount("SELECT idx FROM member where id='{$id}'") <= 1, "중복된 아이디가 있습니다.");
				$salt = "webskills";
				$pw = hash("sha256",$pw.$salt);
				$this->sql = "
					UPDATE member SET
					id='{$id}',
					pw='{$pw}',
					name='{$name}'
					where idx='{$param->idx}'
				";				
			break;
		}
		$this->query();
		alert($msg);
		move($url);
	}
}