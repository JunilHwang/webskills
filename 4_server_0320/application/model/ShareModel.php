<?php
class ShareModel extends Model {
	function setInAdd(){
		$param = $this->getParam();
		$fidx = $param->idx;
		$midx = $this->cr->member->idx;
		$this->sql = "
			INSERT INTO infile_list SET
			fidx = '{$fidx}',
			midx = '{$midx}',
			regdate = now();
		";
		$this->query();
		alert('공유되었습니다.');
		move();
	}

	function setOutAdd(){
		$param = $this->getParam();
		$fidx = $param->idx;
		$midx = $this->cr->member->idx;
		$keycode = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		$len = strlen($keycode);
		$ukey = "";
		while(1){
			$ukey = '';
			for($i=0;$i<4;$i++) $ukey .= $keycode[rand(0,$len-1)];
			if(preg_match("/([0-9]+)/",$ukey) == 0) continue;
			if($this->rowCount("SELECT ukey FROM outfile_list where ukey = '{$ukey}'")) continue;
			break;
		}
		$this->sql = "
			INSERT INTO outfile_list SET
			fidx = '{$fidx}',
			midx = '{$midx}',
			ukey = '{$ukey}',
			regdate = now();
		";
		$this->query();
		alert('공유되었습니다.');
		move();
	}

	function getInList(){
		$this->sql = "
			SELECT  i.*,
					m.name as member_name,
					m.id as member_id,
					f.com_name as file_name,
					f.size as file_size
			FROM 	infile_list i
			join 	member m on i.midx = m.idx
			join 	files f on i.fidx = f.idx
			order by regdate desc;
		";
		return $this->fetchAll();
	}

	function getOutList(){
		$this->sql = "
			SELECT  i.*,
					m.name as member_name,
					m.id as member_id,
					f.com_name as file_name,
					f.size as file_size
			FROM 	outfile_list i
			join 	member m on i.midx = m.idx
			join 	files f on i.fidx = f.idx
			order by regdate desc;
		";
		return $this->fetchAll();
	}
}