<?php 
	$file_list = fetchAll("SELECT * FROM files where midx='{$idx}'");
	foreach($file_list as $data){
		@unlink(DATA_PATH."/{$data->change_name}");
	}
	$sql = "
		DELETE FROM member where idx='{$idx}';
		DELETE FROM files where midx='{$idx}';
		DELETE FROM outfile_list where midx='{$idx}';
		DELETE FROM infile_list where midx='{$idx}';
	";
	query($sql);
	alert("완료되었습니다.");
	move();