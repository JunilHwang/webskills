<?php
class CourseController extends Controller {

	function view () {
		$this->setAjax();
		$this->data = $this->model->getData();
		$this->path = json_decode($this->data->list);
		$this->path_shortest = json_decode($this->data->shortest_list);
		$this->path_length = count($this->path[0]->label);
	}

	function list () {
		$this->site_title = "{$this->param->site_title} &gt; 추천 코스 여행";
		$param = $this->param;
		$model = $this->model;
		$this->total = $total = $model->getListCount($this->model->table->course);
		$line = 10;
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
		$this->data = $this->model->getData();
		$path = json_decode($this->data->list);
		$this->path = $path[0];
		$this->destination = $this->model->getAllDestination();
	}

	function delete () {
		$this->model->deleteData($this->model->table->course);
		alert('삭제되었습니다.');
		move();
		exit;
	}
}