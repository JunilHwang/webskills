<?php
class MainController extends Controller {

	function main () {
		$this->list = $this->model->getMainList();
		$this->site_title = "여수시 관광정보";
	}

}