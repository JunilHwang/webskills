<?php
	query("UPDATE infile_list SET cnt=cnt+1 where idx='{$_GET['idx']}'");
	$sql = "
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
	";
	$data = fetch($sql);
	$path = DATA_PATH."/{$data->change_name}";
	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"{$data->file_name}\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: {$data->file_size}");
	ob_clean();
	flush();
	readfile($path);
	exit;