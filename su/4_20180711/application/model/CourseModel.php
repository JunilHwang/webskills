<?php
class CourseModel extends DefaultModel {
	
	function getJoined () {
		$table = $this->table;
		$uri = UP_URL."/";
		return "
			SELECT * FROM (
				SELECT	c.*,
						f.origin, f.saved,
						concat('{$uri}', f.saved) as uri,
						m.name as writer_name
				FROM	{$table->course} c LEFT
				JOIN 	{$table->file} f on f.idx = c.idx and f.tbl = '{$table->course}'
				JOIN 	{$table->member} m on m.idx = c.writer
			) tt
		";
	}

	function action () {
		extract($_POST);
		$sql = $add_sql = $column = $msg = $url = '';
		$param = $this->param;
		$cancel = 'action/idx/pw_re/beforeFile/check_list/check_list_string';
		switch ($action) {
			case 'insert' :
				$add_sql .= ", date = now()";
				$msg = "추가되었습니다.";
				$url = "{$param->get_page}/list";

				$shortest1 = Shortest::getPathList($this, $check_list, $check_list_string, 1);
				$shortest2 = Shortest::getPathList($this, $check_list, $check_list_string, 2);
				$_POST['shortest_list'] = json_encode([$shortest1[0], $shortest2[0]]);
				$_POST['list'] = json_encode([$shortest1[1], $shortest2[1]]);

				$callback = function ($model) {
					$tbl = $model->table->course;
					$idx = $model->lastId;
					fileUpload($tbl, $idx, $_FILES['file'], $model);
				};
			break;
			case 'update' :
				$add_sql .= " where idx = '{$param->idx}'";
				$msg = "수정 되었습니다.";
				$url = "{$param->get_page}/list";

				$shortest1 = Shortest::getPathList($this, $check_list, $check_list_string, 1);
				$shortest2 = Shortest::getPathList($this, $check_list, $check_list_string, 2);
				$_POST['shortest_list'] = json_encode([$shortest1[0], $shortest2[0]]);
				$_POST['list'] = json_encode([$shortest1[1], $shortest2[1]]);

				$callback = function ($model) {
					$tbl = $model->table->course;
					$idx = $model->param->idx;
					fileUpload($tbl, $idx, $_FILES['file'], $model, true);
				};
			break;
		}

		$column = $this->getColumn($_POST, $cancel);
		if ($this->query_action($action, $this->table->course, $column.$add_sql)){
			if (isset($callback)) $callback($this);
			alert($msg);
			move($url);
		}
	}

}