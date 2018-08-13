<?php
class TourModel extends DefaultModel {

	function getJoined () {
		$uri = UP_URL."/";
		return "
			SELECT * FROM (
				SELECT	t.*,
						f.origin, f.saved,
						concat('{$uri}', f.saved) as uri
				FROM	{$this->table->tour} t LEFT
				JOIN 	{$this->table->file} f on f.idx = t.idx and f.tbl = '{$this->table->tour}'
			) t
		";
	}

	function appendSearch () {
		$key = $this->param->search_key;
		$cond = strpos(strtolower($this->sql), "where") !== false ? ' and ' : ' where ';
		$this->sql .= "{$cond} (subject like '%{$key}%' or content like '%{$key}%')";
	}

	function appendTag () {
		$this->sql .= " where (idx in (SELECT destination FROM {$this->table->tag} where name='{$this->param->tag}'))";
	}

	function getTagList () {
		$this->sql = "
			SELECT 	count(*) as cnt,
					name
			FROM 	{$this->table->tag}
			group by name
			order by cnt desc, name asc
		";
		return $this->fetchAll();
	}

	function keywordRegister ($key) {
		$tbl = $this->table;
		if($key == "") return;
		$last = $this->fetch("SELECT * FROM {$tbl->searched} order by idx desc limit 1");
		$key_list = $last ? json_decode($last->key_list) : [];

		// 검색 기록이 없을경우 or 마지막 검색어 리스트에 현재 검색 키워드가 존재할 경우
		if ($last === false || in_array($key, $key_list)) {
			// 새로운 검색어 리스트 추가
			$sql = "INSERT INTO {$tbl->searched} SET key_list = ?";
			$key_list = json_encode([$key]);
			$execArr = [$key_list];
		} else {
			// 현재 검색어 리스트에 현재 키워드를 추가
			$key_list[] = $key;
			$key_list = json_encode($key_list);
			$sql = "UPDATE {$tbl->searched} SET key_list = ? where idx = ?";
			$execArr = [$key_list, $last->idx];
		}
		$this->sql = $sql;
		$this->execArr = $execArr;
		$this->query();
	}

	function tagInsert ($idx) {
		$tags = explode(" ", $_POST['tag']);
		$sql = "";
		foreach ($tags as $tag) {
			$sql .= "INSERT INTO {$this->table->tag} SET destination = '{$idx}', name = '{$tag}'; \n";
		}
		$this->sql = $sql;
		$this->query();
	}

	function action () {
		extract($_POST);
		$sql = $add_sql = $column = $msg = $url = '';
		$cancel = 'action/idx/pw_re/';
		switch ($action) {
			case 'insert' :
				$msg = "추가되었습니다.";
				$url = "{$this->param->get_page}/list";
				$callback = function ($model) {
					$tbl = $model->table->tour;
					$idx = $model->lastId;
					fileUpload($tbl, $idx, $_FILES['file'], $model);
					$model->tagInsert($idx);
				};
			break;
		}

		$column = $this->getColumn($_POST, $cancel);
		if ($this->query_action($action, $this->table->tour, $column)){
			if (isset($callback)) $callback($this);
			alert($msg);
			move($url);
		}
	}

}