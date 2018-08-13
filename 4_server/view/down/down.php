<?php 
	$data = fetch("SELECT * FROM files where idx='{$_GET['idx']}'");
	$path = DATA_PATH."/{$data->change_name}";
	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"{$data->com_name}\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: {$data->size}");
	ob_clean();
	flush();
	readfile($path);
	exit;