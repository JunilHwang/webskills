<?php
class ReviewController extends Controller {

	function view () {
		$this->setAjax();
		$this->data = $this->model->getData();
	}

	function list () {
		$this->site_title = "{$this->param->site_title} &gt; 관광지 리뷰";
		$param = $this->param;
		$model = $this->model;

		$this->total = $total = $model->getListCount($this->model->table->board);
		$line = 8;
		$this->list = $model->getList(($param->page_num - 1) * $line, $line);
		$url = "{$param->get_page}/list/{{num}}";
		$this->paginate = pagination($url, $param->page_num, $line, $total);
	}

	function write () {
		$this->setAjax();
		$this->destination = $this->model->getAllDestination();
	}

	function update () {
		$this->view();
		$this->destination = $this->model->getAllDestination();
	}

	function delete () {
		$this->model->deleteData($this->model->table->board);
		alert('삭제되었습니다.');
		move();
		exit;
	}
}