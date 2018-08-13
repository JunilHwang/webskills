<?php
class DownModel extends Model {
	function getFile(){
		return $this->fetch("SELECT * FROM files where idx='{$_GET['idx']}'");
	}

	function getShareFile(){
		$this->query("UPDATE infile_list SET cnt=cnt+1 where idx='{$_GET['idx']}'");
		return $this->fetch("
			SELECT  i.*,
					m.name as member_name,
					m.id as member_id,
					f.com_name as file_name,
					f.change_name as change_name,
					f.size as file_size
			FROM 	infile_list i
			join 	member m on i.midx = m.idx
			join 	files f on i.fidx = f.idx
			where i.idx='{$_GET['idx']}'
		");
	}

	function getOutShareFile(){
		$this->query("UPDATE outfile_list SET cnt=cnt+1 where ukey='{$_GET['q']}'");
		return $this->fetch("
			SELECT  o.*,
					m.name as member_name,
					m.id as member_id,
					f.com_name as file_name,
					f.change_name as change_name,
					f.size as file_size
			FROM 	outfile_list o
			join 	member m on o.midx = m.idx
			join 	files f on o.fidx = f.idx
			where o.ukey='{$_GET['q']}'
		");
	}
}