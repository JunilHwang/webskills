<?php
class Shortest {

	static private $path;
	static private $min;
	static private $arr;
	static private $origin;
	static private $len;
	static private $cost_list;
	static private $label;

	// 초기화
	static function init () {
		self::$path = [];
	}

	// 분기와 한정 : 전체 경로 탐색
	static function shortPathTree ($start, $arr, $step, $p, $min, $cost_list) {
		if (self::$min < $min) return;
		if ($step === self::$len) {
			if ($min < self::$min) {
				self::$min = $min;
				self::$path = $p;
				self::$cost_list = $cost_list;
			}
			return;
		}
		foreach ($arr as $key=>$val) {
			if (in_array($key, $p)) continue;
			$new_p = $p;
			$new_cost = $cost_list;
			$cost = $arr[$start][$key]->cost;
			$new_p[] = $key;
			$new_cost[] = $cost;
			self::shortPathTree($key, $arr, $step+1, $new_p, $min + $cost, $new_cost);
		}
	}

	// 최단 경로 구하기
	static function allShortPath () {
		$list = $label = [];
		$arr = self::$arr;
		$len = self::$len = count($arr);

		for ($i = 0; $i < $len; $i++)
			self::shortPathTree($i, $arr, 1, [$i], 0, []);

		for ($i = 0; $i < $len; $i++) {
			$label[] = self::$label[self::$path[$i]];
		}

		return ['idx'=>self::$path, 'total'=>self::$min, 'cost'=>self::$cost_list, 'label'=>$label];
	}

	static function getPathList ($model, $origin, $origin_label, $type) {
		self::$min = 10000;
		self::$label = explode(',', $origin_label);
		$origin = explode(",",$origin);
		$origin_data = Shortest::getData($model, $origin, $type);
		$origin_data['idx'] = $origin;
		$origin_data['label'] = self::$label;

		sort($origin);
		$arr = [];
		foreach($origin as $idx=>$val) {
			$list = $origin;
			unset($list[$idx]);
			$list = implode(",",$origin);
			$model->sql = "
				SELECT 	*
				FROM 	{$model->table->cost}
				where 	type = {$type}
				and 	source = {$val}
				and 	destination in ($list)
				order by destination asc;
			";
			$arr[] = $model->fetchAll();
		}
		self::$arr = $arr;
		$result = Shortest::allShortPath();
		return [$result, $origin_data];
	}

	static function getData ($model, $arr, $type) {
		$arr_data = ['cost'=>[], 'total'=>0];
		$total = 0;
		for ($i = 0, $len = count($arr) -1; $i < $len; $i++) {
			$model->sql = "
				SELECT 	*
				FROM 	{$model->table->cost}
				where 	type = {$type}
				and 	source = {$arr[$i]}
				and 	destination = {$arr[$i+1]}
			";
			$data = $model->fetch();
			$cost = $data->cost;
			$arr_data['cost'][] = $cost;
			$total += $cost;
		}
		$arr_data['total'] = $total;
		return $arr_data;
	}
}