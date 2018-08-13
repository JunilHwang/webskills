<?php
	include_once("config.php");
	$model = new Model();
	$list = $model->fetchAll("SELECT key_list FROM {$model->table->searched}");

	$key_list = [];
	$unique = $stack = [];

	/* unique keyword 구하기 */
	foreach ($list as $data) {
		$keys = json_decode($data->key_list);
		$key_list[] = $keys;
		foreach ($keys as $idx=>$key) {
			$unique[$key] = isset($unique[$key])
							? ++$unique[$key]
							: 1;
			if($unique[$key] > 2) $stack[$key] = [];
		}
	}

	/* value 기준으로 내림차순 */
	arsort($unique);

	/* keyword list 정제 */
	$new_list = [];
	foreach ($key_list as $list) {
		$arr = [];
		foreach ($list as $key)
			if ($unique[$key] > 2)
				$arr[$key] = $unique[$key];
		arsort($arr);
		if (count($arr)) $new_list[] = $arr;
	}

	/* tree 및 stack 생성 */
	foreach ($new_list as $list) {
		$ptr = &$root;
		$parent = null;
		$oneStack = [];
		foreach ($list as $key=>$val) {
			$oneStack[] = $key;
			if (isset($ptr[$key]))
				$ptr[$key]['cnt'] += 1;
			else {
				$ptr[$key] = ['cnt'=>1, 'children'=>[]];
				$stack[$key][] = $oneStack;
			}
			$ptr = &$ptr[$key]['children'];
		}
	}