<?php
	include_once("config.php");	
	$model = new Model();
	$arr = [1,2,3,4];
	$res = $default = [];
	foreach($arr as $idx=>$val) {
		$list = $arr;
		unset($list[$idx]);
		$list = implode(",",$arr);
		$model->sql = "
			SELECT 	*
			FROM 	{$model->table->cost}
			where 	type = 1
			and 	source = {$val}
			and 	destination in ($list)
			order by destination asc;
		";
		$res[] = $model->fetchAll();
		if ($idx < count($arr) - 1) {
			$model->sql = "SELECT * FROM {$model->table->cost} where type = 1 and source = {$arr[$idx]} and destination = {$arr[$idx+1]}";
			$default[] = $model->fetch();
		}
	}

	$result = Shortest::allShortPath($res, $arr);

	print_pre($default, false);
	print_pre($result);