<?php
namespace App\Controller;
use \App\Core\{Controller, Model};
use function \App\Core\{print_pre, println, access, alert, move, up_file};

class PageController extends Controller {
	function menu_set () {
		$this->main_menu = Model::fetchAll("SELECT * FROM site_menu where parent = 0 order by od asc");
		$this->sub_menu = [];
		foreach ($this->main_menu as $main) {
			$this->sub_menu[$main->idx] = Model::fetchAll("SELECT * FROM site_menu where parent = '{$main->idx}' order by od asc");
		}
	}

	function page () {
		$this->menu_set();
		$this->ani = json_decode(Model::fetch("SELECT * FROM site_meta where meta_key = 'animation'")->meta_value);
		$this->content_meta = Model::fetchAll("SELECT * FROM main_content_meta order by od asc");
		$this->main_content = [];
		$this->board = [];
		$this->board_type = [];
		foreach ($this->content_meta as $dep1) {
			$this->main_content[$dep1->idx] = Model::fetchAll("SELECT * FROM main_content where parent = '{$dep1->idx}'");
			foreach ($this->main_content[$dep1->idx] as $dep2) {
				if ($dep2->bidx != 0) {
					$this->board_set[$dep2->idx] = Model::fetch("SELECT * FROM board_set where idx = '{$dep2->bidx}'");
					$this->board[$dep2->idx] = Model::fetchAll("SELECT * FROM board where bds_idx = '{$dep2->bidx}' order by idx desc limit 6");
				}
			}
		}
	}

	function menu () {
		$this->menu_set();
		$this->active_menu = Model::fetch("SELECT * FROM site_menu where idx = '{$this->param->idx}'");
	}
}








