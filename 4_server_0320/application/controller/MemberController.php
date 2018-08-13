<?php
	Class MemberController extends Controller {

		function list(){
			$this->list = $this->model->getMemberList();
		}
		function update(){
			$this->data = $this->model->getMember();
		}
		function delete(){
			$this->data = $this->model->setMemberDelete();
		}
		
	}