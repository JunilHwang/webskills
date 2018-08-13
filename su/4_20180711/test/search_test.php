<?php
	include_once("config.php");

	$arr = json_encode(["a","b","c","d"]);

	print_pre($arr, false);

	if (in_array("e", json_decode($arr)))
		echo "exist";

	$model = new Model();
	$last = $model->fetch("SELECT * FROM {$model->table->searched} order by idx desc limit 1");

	$key_list = $last ? json_decode($last->key_list) : ["a"];

	print_pre($key_list, false);