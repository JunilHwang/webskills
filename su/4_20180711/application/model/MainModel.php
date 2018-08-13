<?php
class MainModel extends Model {

	function getMainList () {
		$uri = UP_URL."/";
		$this->sql = "
			SELECT	t.*,
					f.origin, f.saved,
					concat('{$uri}', f.saved) as uri
			FROM	{$this->table->tour} t LEFT
			JOIN 	{$this->table->file} f on f.idx = t.idx and f.tbl = '{$this->table->tour}'
			LIMIT 8
		";
		return $this->fetchAll();
	}

}