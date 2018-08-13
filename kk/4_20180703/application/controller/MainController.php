<?php
class MainController extends Controller {
	function main () {
		$this->list = $this->model->getList();
	}
}