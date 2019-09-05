<?php
	class AdminModel extends Model{
		/**
		 * 가맹점 or 메뉴 목록
		 * @return object list
		 */
		function getList($table,$add_sql = false){
			$this->sql = "SELECT * FROM `{$table}`";
			if($add_sql) $this->sql .= $add_sql;
			$list = $this->fetchAll();
			return $list;
		}

		/**
		 * 주문 목록
		 */
		function getOrderList(){
			$franchisee = $this->fetch("SELECT * FROM franchisee where midx = '{$this->param->member->idx}'");
			$list = $this->fetchAll("SELECT * FROM member m JOIN deliveryorder d ON m.idx = d.midx where d.fidx = '{$franchisee->idx}'");
			return $list;
		}

		function action(){
			$add_sql = $msg = $url = "";
			extract($_POST);
			switch ($action) {
				case 'franchisee':
					$file = $_FILES['file'];
					access(is_uploaded_file($file['tmp_name']),"로고를 선택하세요.");
					$_POST['logo'] = file_upload($file);
					if($this->rowCount("SELECT * FROM franchisee where midx = '{$this->param->member->idx}'")) $action = "update";
					else $action = "insert";
					$table = "franchisee";
					$add_sql = ", midx = '{$this->param->member->idx}'";
					$msg = "등록 되었습니다.";
					$url = HOME."/admin/affiliation";
					break;
				case 'menuInsert':
					access($data = $this->fetch("SELECT * FROM franchisee where midx = '{$this->param->member->idx}'"),"등록된 가맹점이 없습니다.");
					$action = "insert";
					$table = "menu";
					$add_sql = ", fidx = '{$data->idx}', date = now(), midx = '{$this->param->member->idx}'";
					$msg = "등록 되었습니다.";
					$url = HOME."/admin/affiliation";
					break;
			}
			$cancel = "action/";
			$column = $this->getColumn($_POST,$cancel).$add_sql;
			$this->querySet($action,$table,$column);
			alert($msg);
			move($url);
		}

		function menuDelete(){
			$this->sql = "DELETE FROM menu where idx = '{$_GET['idx']}'";
			$this->query();
			move(HOME."/admin/affiliation");
		}

		function delivery(){
			$this->sql = "UPDATE deliveryorder SET state = 'completed' where idx = '{$_GET['idx']}'";
			$this->query();
			move(HOME."/admin/affiliation");
		}

		function getAllMenuList(){
			$list = $this->fetchAll("SELECT m.*, f.name as franchisee FROM menu m JOIN franchisee f ON f.idx = m.fidx order by quantity desc");
			return $list;
		}
	}