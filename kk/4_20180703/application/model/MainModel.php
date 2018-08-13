<?php
Class MainModel extends Model {
	function getList () {
		$sql = "
			SELECT 	p.*,
					f.name,
					f.uri,
					v.root
			FROM 	project p
			JOIN 	project_version v on v.project = p.idx
			LEFT JOIN file f on p.icon = f.idx
			where v.version = p.version
			order by p.`date` desc
		";
		return $this->fetchAll($sql);
	}
}