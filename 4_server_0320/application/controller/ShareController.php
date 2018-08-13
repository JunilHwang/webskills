<?php
	Class ShareController extends Controller {

		function in(){
			$this->model->setInAdd();
			exit;
		}

		function out(){
			$this->model->setOutAdd();
			exit;			
		}

		function in_list(){
			$this->list = $this->model->getInList();
		}

		function out_list(){
			$this->list = $this->model->getOutList();
		}
	}