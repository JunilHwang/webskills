<?php
namespace App\Model;

use \App;

class AdminModel extends Core {
	function action () {
		$table = \App\Core\Table::getInstance();
		extract($_POST);
		switch ($_POST['action']) {
			case 'login' :
				$this->execArr = [$id, $pw];
				access($member = $this->fetch("SELECT * FROM {$table->member} where id = ? and pw = ?"), "아이디 또는 비밀번호가 일치하지 않습니다.");
				$_SESSION['member'] = $member;
				alert('로그인 되었습니다.');
				move('/admin');
			break;
			case 'update' :
			break;
			case 'delete' :
			break;
		}
	}
}