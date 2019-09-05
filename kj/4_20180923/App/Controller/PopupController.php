<?php
namespace App\Controller;
use \App\Core\{Controller, Model};
use function \App\Core\{print_pre, println, alert, move, access, up_file};

class PopupController extends Controller {
	function setTemplate () {
		$this->template = 'popup';
	}

	function getBoardList () {
		$this->list = Model::fetchAll("SELECT * FROM board_set order by idx asc");		
	}

	function main_page_cont_set () {
		$this->getBoardList();
	}

	function main_page_cont_set_update () {
		$this->getBoardList();
		$this->content = Model::fetch("SELECT * FROM main_content where idx = '{$this->param->idx}'");
	}

	function menu_contents () {
		$this->getBoardList();
		$this->data = Model::fetch("SELECT * FROM site_menu where idx = '{$this->param->idx}'");
	}

	function post_action () {
		extract($_POST);
		switch ($action) {
			case 'board_set' :
				$od = Model::fetch("SELECT max(od) as od FROM main_content where parent = '{$this->param->idx}'")->od + 1;
				$sql = "
					INSERT INTO main_content SET
					parent = '{$this->param->idx}',
					od = '{$od}',
					bidx = '{$bidx}'
				";
			break;
			case 'banner_set' :
				$od = Model::fetch("SELECT max(od) as od FROM main_content where parent = '{$this->param->idx}'")->od + 1;
				$default_image = up_file($_FILES['def_img'])[1];
				$over_image = up_file($_FILES['over_img'])[1];
				$sql = "
					INSERT INTO main_content SET
					parent = '{$this->param->idx}',
					od = '{$od}',
					default_image = '{$default_image}',
					over_image = '{$over_image}',
					link_url = '{$link_url}',
					link_type = '{$link_type}';
				";
			break;
			case 'board_set_update' :
				$sql = "
					UPDATE main_content SET
					bidx = '{$bidx}',
					default_image = '',
					over_image = '',
					link_url = '',
					link_type = ''
					where idx = '{$this->param->idx}'
				";
			break;
			case 'banner_set_update' :
				$default_image = up_file($_FILES['def_img'])[1];
				$over_image = up_file($_FILES['over_img'])[1];
				$sql = "
					UPDATE main_content SET
					default_image = '{$default_image}',
					over_image = '{$over_image}',
					link_url = '{$link_url}',
					link_type = '{$link_type}',
					bidx = 0
					where idx = '{$this->param->idx}';
				";
			break;
			case 'color_set' :
				$sql = "
					UPDATE main_content_meta SET
					top_color = '{$top_color}',
					btm_color = '{$btm_color}',
					bg_color = '{$bg_color}'
					where idx = '{$this->param->idx}';
				";
			break;
			case 'content-board' :
				$sql = "UPDATE site_menu SET type = '게시판', bidx = '{$bidx}' where idx = '{$this->param->idx}';";
			break;
			case 'content-html' :
				$sql = "UPDATE site_menu SET type = 'HTML', bidx = 0, content = ? where idx = '{$this->param->idx}';";
				Model::$execArr = [$content];
			break;
		}
		Model::query($sql);
		alert('완료되었습니다.');
		echo "<script>window.opener.location.reload(); window.close()</script>";
	}
}