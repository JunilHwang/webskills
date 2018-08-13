<?php
	$base_path = __DIR__;
	$base_url = "/0927";
	$db = new PDO("mysql:host=127.0.0.1;dbname=0927;charset=utf8","root","");
	header("Content-type:text/html;charset=utf8");
	include("{$base_path}/include/config.php");
	include("{$base_path}/include/process.php");
	include("{$base_path}/header.php");
	include("{$base_path}/page/{$type}/{$include_file}.php");
	include("{$base_path}/footer.php");
?>