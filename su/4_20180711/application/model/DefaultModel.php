<?php
class DefaultModel extends Model {
	
	function getAllDestination () {
		$this->sql = "SELECT * FROM {$this->table->tour} order by idx desc; ";
		return $this->fetchAll();
	}

	function getData () {
		$sql = $this->getJoined();
		$this->sql = "
			{$sql}
			WHERE idx = '{$this->param->idx}';
		";
		return $this->fetch();
	}

	function getListCount ($table) {
		$this->sql = "SELECT count(idx) as cnt FROM {$table}";
		if(isset($this->param->tag)) $this->appendTag();
		if(isset($this->param->search_key)) $this->appendSearch();
		return $this->fetch()->cnt;
	}

	function getList ($start, $line) {
		$this->sql = $this->getJoined();
		if(isset($this->param->tag)) $this->appendTag();
		if(isset($this->param->search_key)) $this->appendSearch();
		$this->sql .= "
			order by idx desc
			limit {$start}, {$line}
		";
		return $this->fetchAll();
	}

	function deleteData ($table) {
		if ( $file = $this->fetch("SELECT * FROM {$this->table->file} where tbl = '{$table}' and idx = '{$this->param->idx}'") ) {
			@unlink(_UPDIR."/{$file->saved}");
		}
		$this->sql = "
			DELETE FROM {$table} where idx = '{$this->param->idx}';
			DELETE FROM {$this->table->file} where tbl = '{$table}' and idx = '{$this->param->idx}';
		";
		$this->query();
	}

}