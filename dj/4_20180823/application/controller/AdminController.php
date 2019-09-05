<?php
	class AdminController extends Controller{
		/**
		 * affiliation page
		 */
		function affiliation(){
			access($this->param->isMember && $this->param->member->level == "AD" || $this->param->member->level == "AF","가맹회원 또는 관리자만 접근가능합니다.");
			if($this->param->member->level == "AF"){
				$this->franList = $this->model->getList("franchisee"," where midx = '{$this->param->member->idx}'");
				$this->menuList = $this->model->getList("menu"," where midx = '{$this->param->member->idx}'");
				$this->orderList = $this->model->getOrderList();
			}
			else if($this->param->member->level == "AD"){
				$this->idx = isset($_GET['idx']) ? $_GET['idx'] : 1;
				$this->franList = $this->model->getList("franchisee");
				$this->menuList = $this->model->getList("menu"," where fidx = '{$this->idx}'");
				$this->allMenuList = $this->model->getAllMenuList();
			}
		}

		function menuDelete(){
			$this->model->menuDelete();
		}

		function delivery(){
			$this->model->delivery();
		}
	}