<?php
namespace App\Controller;
use \App\Core\{Controller, Model};
use function \App\Core\{print_pre, println, access, alert, move, up_file};

class AdminController extends Controller {
	
	function setTemplate () {
		$this->template = 'admin';
	}

	function logout () {
		unset($_SESSION['member']);
		alert('로그아웃 되었습니다.');
		move(HOME_URL.'/');
	}

	function menu_toggle () {
		if (isset($_SESSION['menu_toggle'])) {
			unset($_SESSION['menu_toggle']);
		} else {
			$_SESSION['menu_toggle'] = true;
		}
		move(HOME_URL.'/'.$_GET['back']);
	}

	function menu_set () {
		$prefix = "SELECT s.*, b.name as board_title FROM site_menu s left join board_set b on s.bidx = b.idx";
		$this->list = Model::fetchAll("{$prefix} where parent = '0' order by od asc");
		$this->child = [];
		foreach ($this->list as $data) {
			$this->child[$data->idx] = Model::fetchAll("{$prefix} where parent = '{$data->idx}' order by od asc");
		}
	}

	function menu_contents () {
		$this->menu_set();
	}

	function menu_set_add () {
		$od = Model::fetch("SELECT max(od) as od FROM site_menu where parent = '0';")->od + 1;
		$parent = isset($this->param->idx) ? $this->param->idx : 0;
		$sql = "INSERT INTO site_menu SET title = '', hide = 1, parent = '{$parent}', od = '{$od}';";
		Model::query($sql);
		move($this->param->get_page.'/menu_set');
	}

	function menu_delete () {
		$sql = "DELETE FROM site_menu where idx = '{$this->param->idx}' or parent = '{$this->param->idx}';";
		Model::query($sql);
		alert('삭제되었습니다.');
		move($this->param->get_page.'/menu_set');
		exit;
	}

	function main_page () {
		$this->content_meta = Model::fetchAll("SELECT * FROM main_content_meta order by od asc");
		$this->step = [];
		foreach ($this->content_meta as $data) {
			$step = Model::fetchAll("
				SELECT  m.*, b.name
				FROM 	main_content m
				left JOIN	board_set b on b.idx = m.bidx
				where 	parent = '{$data->idx}' order by od asc
			");
			$this->step[$data->idx] = $step;
		}
	}

	function step_add () {
		$od = Model::fetch("SELECT max(od) as od FROM main_content_meta")->od + 1;		
		Model::query("INSERT INTO main_content_meta SET od = '{$od}'");
		move($this->param->get_page.'/main_page');
	}

	function main_image_design () {
		$data = Model::fetch("SELECT * FROM site_meta where meta_key = 'animation'");
		if ($data) {
			$this->data = json_decode($data->meta_value);
		} else {
			$this->data = (Object)[
				"left_back"=>"",
				"m_img"=> [
					(Object)["saved_name"=>"", "origin_name"=>""],
					(Object)["saved_name"=>"", "origin_name"=>""],
					(Object)["saved_name"=>"", "origin_name"=>""]
				],
				"right_back"=>"",
				"second"=>""	
			];
			$data_json = json_encode($this->data);
			Model::$execArr = [$data_json];
			Model::query("INSERT INTO site_meta SET meta_key = 'animation', meta_value = ?");
		}
	}

	function main_image_design_delete () {
		$this->main_image_design();
		switch ($this->param->idx) {
			case 'm_img1' :
				$this->data->m_img[0] = (Object)["saved_name"=>"", "origin_name"=>""];
			break;
			case 'm_img2' :
				$this->data->m_img[1] = (Object)["saved_name"=>"", "origin_name"=>""];
			break;
			case 'm_img3' :
				$this->data->m_img[2] = (Object)["saved_name"=>"", "origin_name"=>""];
			break;
			default :
				$this->data->{$this->param->idx} = null;
			break;
		}
		$data_json = json_encode($this->data);
		Model::$execArr = [$data_json];
		Model::query("UPDATE site_meta SET meta_value = ? where meta_key = 'animation';");
		alert('삭제되었습니다.');
		move($this->param->get_page.'/main_image_design');
	}

	function board_set () {
		$this->list = Model::fetchAll("
			SELECT b.*, (SELECT count(*) as cnt from board where bds_idx = b.idx) as cnt FROM board_set b order by idx asc
			");
	}

	function board_set_modify () {
		$this->data = Model::fetch("SELECT * FROM board_set where idx = '{$this->param->idx}'");
	}

	function post_action () {
		extract($_POST);
		switch ($action) {
			case 'login':
				$sql = "SELECT * FROM member where binary(userid) = '{$userid}' and binary(pw) = '{$pw}' ";
				access($member = Model::fetch($sql), "아이디 혹은 비밀번호가 일치하지 않습니다.");
				$_SESSION['member'] =  $member;
				alert('로그인 되었습니다.');
				move($this->param->get_page);
			break;
			case 'menu_set' :
				$sql = "";
				$unset = [];
				if (isset($main_od)) foreach ($main_od as $mod=>$midx) {
					$sql .= "
						UPDATE site_menu SET
						idx = '{$midx}',
						od = '{$mod}',
						parent = '0',
						title = '{$m_title[$midx]}',
						hide = '{$m_hide[$midx]}'
						where idx = '{$midx}';
					";
					if (isset($m_remove[$midx])) $unset[] = $midx;
					if (isset($sub_od[$midx])) foreach ($sub_od[$midx] as $sod=>$sidx) {
						$sql .= "
							UPDATE site_menu SET
							idx = '{$sidx}',
							od = '{$sod}',
							parent = '{$midx}',
							title = '{$s_title[$midx][$sidx]}',
							hide = '{$s_hide[$midx][$sidx]}'
							where idx = '{$sidx}';
						";
						if (isset($s_remove[$midx][$sidx])) $unset[] = $sidx;
					}
				}
				foreach ($unset as $idx) {
					$sql .= "DELETE FROM site_menu where idx = '{$idx}' or parent = '{$idx}';\n";
				}
				Model::query($sql);
				alert('완료되었습니다.');
				move($this->param->get_page.'/menu_set');
			break;
			case 'main_set' :
				$sql = "";
				$p_unset = [];
				$c_unset = [];
				if (isset($p_od)) foreach ($p_od as $pod=>$pidx) {
					$sql .= "
						UPDATE main_content_meta SET od = '{$pod}' where idx = '{$pidx}';
					";
					if (isset($p_remove[$pidx])) $p_unset[] = $pidx;
					if (isset($c_od[$pidx])) foreach ($c_od[$pidx] as $cod=>$cidx) {
						$sql .= "
							UPDATE main_content SET od = '{$cod}' where idx = '{$cidx}';
						";
						if (isset($c_remove[$cidx])) $c_unset[] = $cidx;
					}
				}
				foreach ($p_unset as $idx) {
					$sql .= "
						DELETE FROM main_content_meta where idx = '{$idx}';
						DELETE FROM main_content where parent = '{$idx}';
					";
				}
				foreach ($c_unset as $idx) {
					$sql .= "
						DELETE FROM main_content where idx = '{$idx}';
					";
				}
				Model::query($sql);
				alert('완료되었습니다.');
				move($this->param->get_page.'/main_page');
			break;
			case 'main_image_set' :
				$m_img1 = up_file($_FILES['m_img1']);
				$m_img2 = up_file($_FILES['m_img2']);
				$m_img3 = up_file($_FILES['m_img3']);
				$this->main_image_design();
				$this->data->left_back = $left_back;
				$this->data->right_back = $right_back;
				$this->data->second = $second;
				if (isset($m_img1)) $this->data->m_img[0]->origin_name = $m_img1[0];
				if (isset($m_img1)) $this->data->m_img[0]->saved_name = $m_img1[1];
				if (isset($m_img2)) $this->data->m_img[1]->origin_name = $m_img2[0];
				if (isset($m_img2)) $this->data->m_img[1]->saved_name = $m_img2[1];
				if (isset($m_img3)) $this->data->m_img[2]->origin_name = $m_img3[0];
				if (isset($m_img3)) $this->data->m_img[2]->saved_name = $m_img3[1];
				$data = json_encode($this->data);
				Model::$execArr = [$data];
				Model::query("UPDATE site_meta SET meta_value = ? where meta_key = 'animation';");
				alert('완료되었습니다.');
				move($this->param->get_page.'/main_image_design');
			break;
			case 'board_insert' :
				$sql = "
					INSERT INTO board_set SET
					name = '{$name}',
					type = '{$type}',
					page_cnt = '{$_POST['page_cnt'.$type]}',
					line_cnt = '{$line_cnt}',
					upload_cnt = '{$upload_cnt}',
					upload_size = '{$upload_size}';
				";
				Model::query($sql);
				alert('완료되었습니다.');
				move($this->param->get_page.'/board_set');
			break;
			case 'board_update' :
				$sql = "
					UPDATE board_set SET
					name = '{$name}',
					type = '{$type}',
					page_cnt = '{$_POST['page_cnt'.$type]}',
					line_cnt = '{$line_cnt}',
					upload_cnt = '{$upload_cnt}',
					upload_size = '{$upload_size}'
					where idx = '{$this->param->idx}' 
				";
				Model::query($sql);
				alert('완료되었습니다.');
				move($this->param->get_page.'/board_set');
			break;
		}
	}
}
