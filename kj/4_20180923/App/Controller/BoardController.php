<?php
namespace App\Controller;
use \App\Core\{Controller, Model};
use function \App\Core\{print_pre, println, access, alert, move, up_file};

class BoardController extends PageController {
	function view () {
		$this->menu_set();
		$this->board_set = Model::fetch("SELECT * FROM board_set where idx = '{$_GET['bsidx']}'");
		$this->data = Model::fetch("SELECT * FROM board where idx = '{$this->param->idx}'");
		Model::query("UPDATE board SET hit = hit+1 where idx = '{$this->param->idx}'");
	}

	function list () {
		$this->menu_set();
		$this->board_set = Model::fetch("SELECT * FROM board_set where idx = '{$_GET['bsidx']}'");
		$page_num = $this->param->page_num;
		$total = Model::rowCount("SELECT * FROM board where bds_idx = '{$_GET['bsidx']}'");
		$line = $this->board_set->page_cnt;
		$start = ($page_num - 1) * $line;
		$last = ceil($total / $line);
		$this->board = Model::fetchAll("SELECT * FROM board where bds_idx = '{$_GET['bsidx']}' order by idx desc limit {$start}, {$line}");

		$page_nation = "";
		if ($last != 0) {
			$prev = $page_num <= 1 ? 1 : $page_num - 1;
			$next = $page_num >= $last ? $last : $page_num + 1;
			$prefix = HOME_URL.'/board/list/';
			$suffix = HOME_URL.'?bsidx='.$_GET['bsidx'];
			$page_nation  = '<a href="'.$prefix.$prev.$suffix.'">&lt;</a> ';
			for ($i = 1; $i <= $last; $i++) {
				$page_nation .= '<a href="'.$prefix.$i.$suffix.'">['.$i.']</a> ';
			}
			$page_nation .= '<a href="'.$prefix.$next.$suffix.'">&gt;</a>';
		}
		$this->page_nation = $page_nation;
	}

	function modify () {
		$this->view();
		$this->menu_set();
		$this->board_set = Model::fetch("SELECT * FROM board_set where idx = '{$_GET['bsidx']}'");
		$this->data = Model::fetch("SELECT * FROM board where idx = '{$this->param->idx}'");
	}

	function write () {
		$this->menu_set();
		$this->board_set = Model::fetch("SELECT * FROM board_set where idx = '{$_GET['bsidx']}'");
	}

	function delete () {
		Model::query("DELETE * FROM board where idx = '{$this->param->idx}'");
	}

	function post_action () {
		extract($_POST);
		$board_set = Model::fetch("SELECT * FROM board_set where idx = '{$_GET['bsidx']}'");
		switch ($action) {
			case 'insert' :
				$file_arr = [];
				foreach ($_FILES as $key=>$val) {
					if ($val['size'] > 1024 * 1024 * $board_set->upload_size) {
						alert('업로드 용량을 초과했습니다.');
						move();
						exit;
					}
					$file = up_file($val);
					if (isset($file)) $file_arr[] = $file[1];
				}
				$file_arr = count($file_arr) ? json_encode($file_arr) : "";
				$sql = "
					INSERT INTO board SET
					`bds_idx` = {$_GET['bsidx']},
					`writer` = ?,
					`title` = ?,
					`text` = ?,
					`file` = '{$file_arr}',
					datetime = now()
				";
				Model::$execArr = [$writer,$title,$text];
			break;
			case 'update' :
				$add_sql = "";
				$file_arr = [];
				foreach ($_FILES as $key=>$val) {
					if ($val['size'] > 1024 * 1024 * $board_set->upload_size) {
						alert('업로드 용량을 초과했습니다.');
						move();
						exit;
					}
					$file = up_file($val);
					if (isset($file)) $file_arr[] = $file[1];
				}
				$file_arr = count($file_arr) ? json_encode($file_arr) : "";
				if ($file_arr != "") $add_sql = ", `file` = '{$file_arr}'";
				$sql = "
					UPDATE board SET
					`writer` = ?,
					`title` = ?,
					`text` = ?,
					datetime = now()
					{$add_sql}
					where idx = '{$this->param->idx}'
				";
				Model::$execArr = [$writer,$title,$text];
			break;
		}
		Model::query($sql);
		alert('완료되었습니다.');
		move(HOME_URL."/board/list/1?bsidx={$_GET['bsidx']}");
	}
}








